<?php


class CategoriesController extends AbstractController
{
    public function show($id = null)
    {
        if ($id == null) {
            $em = $this->getEntityManager();
            $query = $em->getRepository(\src\entity\Categories::class);
            /** @var \src\repository\CategoriesRepository $categories */
            $result = $query->getCategories();
        } else {
            $categories = $this->getEntityManager()->getRepository(\src\entity\Categories::class);
            /** @var \src\repository\CategoriesRepository $result */
            $result = $categories->getCategoriesfindBy($id);
        }
        return ['category' => $result];
    }

    public function add()
    {
        if ($_POST['categoriesname'] != null && $_POST['pagetitle']  != null){
        $cate = $_POST['categoriesname'];
        $pagetitle = $_POST['pagetitle'];
        $content = $_POST['content'];
        $metadescc = $_POST['metadesc'];
        $metakey = $_POST['metakey'];
        $em = $this->getEntityManager();
        $category = new \src\entity\Categories();
        $category->setName($cate);
        $category->setPageTitle($pagetitle);
        $category->setContent($content);
        $category->setMetaDesc($metadescc);
        $category->setMetaKey($metakey);
        $em->persist($category);
        $em->flush();
        }else{
            echo 'değerler boş olamaz';
        }
        if ($category->getId()) {
            $_SESSION['basarilikayit'] = 'basarili kayit';
            header('location: /admin/categories');
        }

    }

    public function update()
    {
        $id = $_POST['id'];

        $cate = $_POST['categories'];
        $pageTitle = $_POST['pagetitle'];
        $content = $_POST['content'];
        $metaDesc = $_POST['metadesc'];
        $metaKey = $_POST['metakey'];

        $category = new \src\entity\Categories();
        $em = $this->getEntityManager();
        /** @var \src\entity\Categories $updateCategory */
        $updateCategory = $em->find(\src\entity\Categories::class, $id);
        $updateCategory->setName($cate);
        $updateCategory->setPageTitle($pageTitle);
        $updateCategory->setContent($content);
        $updateCategory->setMetaDesc($metaDesc);
        $updateCategory->setMetaKey($metaKey);
        $em->persist($updateCategory);
        $em->flush();
        $_SESSION['basariliguncelleme'] = 'basarili guncelleme';
        header('location: /admin/categories');
    }


    public function delete($id)
    {
        $em = $this->getEntityManager();
        $delete = $em->find(\src\entity\Categories::class, $id);
        $em->remove($delete);
        $em->flush();
        $_SESSION['basarilisilme'] = 'basarili silme';
        header('location:/admin/categories ');

    }

}