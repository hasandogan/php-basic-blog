<?php

namespace src\repository;

use Doctrine\ORM\EntityRepository;
use src\entity\Article;
use src\entity\Categories;

class ArticleRepository extends EntityRepository
{
    public function findCompleteArticleDataArray($slug)
    {

        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        /** @var Article $article */
        $article = $queryBuilder->select('a')
            ->from(\src\entity\Article::class, 'a')
            ->where($queryBuilder->expr()->like('a.slug', ':slug'))
            ->setParameter(':slug', '%' . $slug . '%')
            ->orderBy('a.slug', 'DESC')
            ->getQuery()
            ->getOneOrNullResult();
        $id = $article->getId();
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder = $queryBuilder->select('c')
            ->from(\src\entity\ArticleCategories::class, 'c')
            ->where($queryBuilder->expr()->eq('c.articleid', ':articleid'))
            ->setMaxResults(1)
            ->setParameter(':articleid', $id);
        $articleCategory = $queryBuilder->getQuery()->getOneOrNullResult();
        $id =$articleCategory->getCategoriesId();
        if ($articleCategory !== null) {
            $category = $this->getEntityManager()
                ->getRepository(Categories::class)->find($id);
        }
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $tags = $queryBuilder->select('t')->select('t')
            ->from(\src\entity\Tags::class, 't')
            ->where($queryBuilder->expr()->eq('t.articleid', ':articleid'))
            ->setParameter(':articleid', $id)
            ->getQuery()
            ->getResult();
        if (count($tags) > 0) {
            $tagArray = [];
            foreach ($tags as $tag) {
                $tagArray[] = $tag;
            }
        }
        $rowArray = [];
        $rowArray[] = $article;
        $rowArray[] = $category;
        $rowArray[] = $tagArray;
        return $rowArray;
    }

    public function getArticleFindById($articleIdList)
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $query = $queryBuilder
            ->select('a')
            ->from(\src\entity\Article::class, 'a')
            ->where($queryBuilder
                ->expr()
                ->in('a.id', $articleIdList));
        return $result = $query->getQuery()->getResult();
    }

    public function getArticle()
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $query = $queryBuilder
            ->select('arc')
            ->from(\src\entity\Article::class, 'arc')
            ->orderBy('arc.id', 'DESC')
            ->setMaxResults(10);
        return $query->getQuery()->getResult();
    }
    public function getArticleForSearch($search){
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $query = $queryBuilder->select('s')
            ->from(\src\entity\Article::class, 's')
            ->where($queryBuilder->expr()->like('s.title', ':search'))
            ->orWhere($queryBuilder->expr()->like('s.content', ':search'))
            ->orWhere($queryBuilder->expr()->like('s.slug', ':search'))
            ->setParameter(':search', '%' . $search . '%');
        return  $result = $query->getQuery()->getResult();
    }
}