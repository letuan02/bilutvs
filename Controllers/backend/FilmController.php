<?php

class FilmController extends BaseController {

    private $filmModel;

    public function __construct() {
        $this->dataUser = parent::checkLogin();
        $this->loadModel('FilmModel');
        $this->filmModel = new FilmModel();
    }

    public function index() {
        $totalFilm = $this->filmModel->getSummary();
        $title = 'List Film';

        $currentPage = isset($_GET['page']) ? $_GET['page'] : 0;
        if ($currentPage > $totalFilm) {
            $currentPage = $totalFilm;
        } else if ($currentPage < 1) {
            $currentPage = 0;
        }

        $limit = 10;
        $totalPage = ceil($totalFilm / $limit);
        $start = ($currentPage - 1) * $limit;

        if ($currentPage > $totalPage) {
            header('Location: ' . DOMAIN . '/?module=backend&controller=film&page=' . $totalPage);
        } else if ($currentPage < 1) {
            header('Location: ' . DOMAIN . '/?module=backend&controller=film&page=1');
        }
        
        $filmData = $this->filmModel->getAllDataFilm($start, $limit);
        
        $this->loadView('partitions.backend.header', [
            'data_user' => $this->dataUser,
            'title' => $title
        ]);
        $this->loadView('partitions.backend.sidebar', [
            'data_user' => $this->dataUser
        ]);
        $this->loadView('backend.film.index', [
            'filmData' => $filmData,
            'totalFilm' => $totalFilm,
            'totalPage' => $totalPage,
            'currentPage' => $currentPage,
        ]);
        $this->loadView('partitions.backend.footer', [
            'data_user' => $this->dataUser
        ]);
    }

    public function add() {
        $cateList = $this->filmModel->getAllByOption('*', 'categories');
        $typeList = $this->filmModel->getAllByOption('*', 'type');
        $countryList = $this->filmModel->getAllByOption('*', 'national');
        $title = 'Add Films';

        if(isset($_POST['add_product'])){
            $errorMessage = array();
            $product = array();
            
            $product['filmName'] = isset($_POST['filmName']) ? $_POST['filmName'] : '';
            $product['filmLink'] = isset($_POST['filmLink']) ? $_POST['filmLink'] : '';
            $product['filmPoster'] = isset($_POST['filmPoster']) ? $_POST['filmPoster'] : '';
            $product['filmThumbnail'] = isset($_POST['filmThumbnail']) ? $_POST['filmThumbnail'] : '';
            $product['filmTotalEpisode'] = isset($_POST['filmTotalEpisode']) ? $_POST['filmTotalEpisode'] : '';
            $product['filmYear'] = isset($_POST['filmYear']) ? $_POST['filmYear'] : '';
            $product['filmNational'] = isset($_POST['filmNational']) ? $_POST['filmNational'] : '';
            $product['filmCate'] = isset($_POST['filmCate']) ? $_POST['filmCate'] : '';
            $product['filmType'] = isset($_POST['filmType']) ? $_POST['filmType'] : '';
            $product['filmDesc'] = isset($_POST['filmDesc']) ? htmlspecialchars(str_replace('\'', '\'\'', $_POST['filmDesc'])) : '';
            $product['filmRealName'] = isset($_POST['filmRealName']) ? str_replace('\'', '\'\'', ($_POST['filmRealName'])) : '';

            if(!$product['filmName']){
                $errorMessage['filmName'] = "Vui l??ng nh???p t??n phim";
            }else{
                $product['filmName'] = $this->filmModel->uppercaseFirstChar($product['filmName']);
            }

            if(!$product['filmRealName']){
                $errorMessage['filmRealName'] = "Vui l??ng nh???p t??n phim";
            }

            if(!$product['filmLink']){
                $errorMessage['filmLink'] = "Vui l??ng nh???p link phim";
            }else if($this->filmModel->checkExits('slug', $product['filmLink'])){
                $errorMessage['filmLink'] = "Link phim ???? t???n t???i";
            }

            if(!$product['filmPoster']){
                $errorMessage['filmPoster'] = "Vui l??ng nh???p link poster";
            }else if(!filter_var($product['filmPoster'], FILTER_VALIDATE_URL)){
                $errorMessage['filmPoster'] = "Vui l??ng nh???p l???i link poster";
            }

            if(!$product['filmThumbnail']){
                $errorMessage['filmThumbnail'] = "Vui l??ng nh???p link thumbnail";
            }else if(!filter_var($product['filmThumbnail'], FILTER_VALIDATE_URL)){
                $errorMessage['filmThumbnail'] = "Vui l??ng nh???p l???i link thumbnail";
            }

            if(!$product['filmTotalEpisode']){
                $errorMessage['filmTotalEpisode'] = "Vui l??ng nh???p t???ng s??? t???p phim";
            }else if($product['filmTotalEpisode'] < 0){
                $errorMessage['filmTotalEpisode'] = "T???ng s??? t???p ph???i l?? s??? d????ng";
            }else if(!is_numeric($product['filmTotalEpisode'])){
                $errorMessage['filmTotalEpisode'] = "Vui l??ng nh???p s???";
            }

            if(!$product['filmYear']){
                $errorMessage['filmYear'] = "Vui l??ng ch???n n??m ph??t h??nh";
            }

            if(!$product['filmNational']){
                $errorMessage['filmNational'] = "Vui l??ng ch???n qu???c gia";
            }

            if(!$product['filmCate']){
                $errorMessage['filmCate'] = "Vui l??ng ch???n th??? lo???i";
            }

            if(!$product['filmType']){
                $errorMessage['filmType'] = "Vui l??ng ch???n lo???i phim";
            }

            if(!$product['filmDesc']){
                $errorMessage['filmDesc'] = "Vui l??ng nh???p m?? t???";
            }

            if(empty($errorMessage)){
                $column = ['name', 'cate_id', 'poster', 'thumbnail', 'description', 'real_name', 'slug', 'total_episode', 'year', 'nation_id', 'type_id'];

                $dataFilm = [
                    "$product[filmName]",
                    "$product[filmCate]",
                    "$product[filmPoster]",
                    "$product[filmThumbnail]",
                    "$product[filmDesc]",
                    "$product[filmRealName]",
                    "$product[filmLink]",
                    "$product[filmTotalEpisode]",
                    "$product[filmYear]",
                    "$product[filmNational]",
                    "$product[filmType]"
                ];
                $this->filmModel->addFilm($column, $dataFilm);
                unset($product);
                $isSuccess = true;
                $product = null;
            }else{
                $isSuccess = false;
            }
        }else{
            $errorMessage = null;
            $product = null;
            $isSuccess = false;
        }

        $this->loadView('partitions.backend.header', [
            'data_user' => $this->dataUser,
            'title' => $title
        ]);
        $this->loadView('partitions.backend.sidebar', [
            'data_user' => $this->dataUser
        ]);
        $this->loadView('backend.film.addFilm', [
            'cateList' => $cateList,
            'typeList' => $typeList,
            'countryList' => $countryList,
            'errorMessage' => $errorMessage,
            'product' => $product,
            'isSuccess' => $isSuccess
        ]);
        $this->loadView('partitions.backend.footer', [
            'data_user' => $this->dataUser
        ]);
    }

    public function edit() {
        $idFilm = $_GET['id'];
        $filmData = $this->filmModel->getDataFilmById($idFilm);
        $countryList = $this->filmModel->getAllByOption('*', 'national');
        $cateList = $this->filmModel->getAllByOption('*', 'categories');
        $typeList = $this->filmModel->getAllByOption('*', 'type');
        $title = 'Update Films';
        $statusList = $this->filmModel->getAllByOption('*', 'status');

        if(isset($_POST['update_film'])){
            $errorMessage = array();
            $product = array();
            
            $product['filmName'] = isset($_POST['filmName']) ? $_POST['filmName'] : '';
            $product['filmLink'] = isset($_POST['filmLink']) ? $_POST['filmLink'] : '';
            $product['filmPoster'] = isset($_POST['filmPoster']) ? $_POST['filmPoster'] : '';
            $product['filmThumbnail'] = isset($_POST['filmThumbnail']) ? $_POST['filmThumbnail'] : '';
            $product['filmTotalEpisode'] = isset($_POST['filmTotalEpisode']) ? $_POST['filmTotalEpisode'] : '';
            $product['filmYear'] = isset($_POST['filmYear']) ? $_POST['filmYear'] : '';
            $product['filmNational'] = isset($_POST['filmNational']) ? $_POST['filmNational'] : '';
            $product['filmCate'] = isset($_POST['filmCate']) ? $_POST['filmCate'] : '';
            $product['filmType'] = isset($_POST['filmType']) ? $_POST['filmType'] : '';
            $product['filmDesc'] = isset($_POST['filmDesc']) ? htmlspecialchars($_POST['filmDesc']) : '';
            $product['filmRealName'] = isset($_POST['filmRealName']) ? $_POST['filmRealName'] : '';
            $product['filmStatus'] = isset($_POST['filmStatus']) ? $_POST['filmStatus'] : '';

            if(!$product['filmName']){
                $errorMessage['filmName'] = "Vui l??ng nh???p t??n phim";
            }else{
                $product['filmName'] = $this->filmModel->uppercaseFirstChar($product['filmName']);
            }

            if(!$product['filmRealName']){
                $errorMessage['filmRealName'] = "Vui l??ng nh???p t??n phim";
            }

            if(!$product['filmLink']){
                $errorMessage['filmLink'] = "Vui l??ng nh???p link phim";
            }else if(($this->filmModel->checkExits('slug', $product['filmLink'])) && ($product['filmLink'] != $filmData['slug'])){
                $errorMessage['filmLink'] = "Link phim ???? t???n t???i";
            }

            if(!$product['filmPoster']){
                $errorMessage['filmPoster'] = "Vui l??ng nh???p link poster";
            }else if(!filter_var($product['filmPoster'], FILTER_VALIDATE_URL)){
                $errorMessage['filmPoster'] = "Vui l??ng nh???p l???i link poster";
            }

            if(!$product['filmThumbnail']){
                $errorMessage['filmThumbnail'] = "Vui l??ng nh???p link thumbnail";
            }else if(!filter_var($product['filmThumbnail'], FILTER_VALIDATE_URL)){
                $errorMessage['filmThumbnail'] = "Vui l??ng nh???p l???i link thumbnail";
            }

            if(!$product['filmTotalEpisode']){
                $errorMessage['filmTotalEpisode'] = "Vui l??ng nh???p t???ng s??? t???p phim";
            }else if($product['filmTotalEpisode'] < 0){
                $errorMessage['filmTotalEpisode'] = "T???ng s??? t???p ph???i l?? s??? d????ng";
            }else if(!is_numeric($product['filmTotalEpisode'])){
                $errorMessage['filmTotalEpisode'] = "Vui l??ng nh???p s???";
            }

            if(!$product['filmYear']){
                $errorMessage['filmYear'] = "Vui l??ng ch???n n??m ph??t h??nh";
            }

            if(!$product['filmNational']){
                $errorMessage['filmNational'] = "Vui l??ng ch???n qu???c gia";
            }

            if(!$product['filmCate']){
                $errorMessage['filmCate'] = "Vui l??ng ch???n th??? lo???i";
            }

            if(!$product['filmType']){
                $errorMessage['filmType'] = "Vui l??ng ch???n lo???i phim";
            }

            if(!$product['filmDesc']){
                $errorMessage['filmDesc'] = "Vui l??ng nh???p m?? t???";
            }

            if($product['filmStatus'] === ''){
                $errorMessage['filmStatus'] = "Vui l??ng ch???n tr???ng th??i phim";
            }

            if(empty($errorMessage)){
                $this->filmModel->update(
                    $product['filmName'],
                    $product['filmRealName'],
                    $product['filmLink'],
                    $product['filmPoster'],
                    $product['filmThumbnail'],
                    $product['filmTotalEpisode'],
                    $product['filmYear'],
                    $product['filmNational'],
                    $product['filmCate'],
                    $product['filmType'],
                    $product['filmStatus'],
                    $product['filmDesc'],
                    $idFilm
                );
                header('Location: '.DOMAIN.'/?module=backend&controller=film');
                // unset($product);
                // $isSuccess = true;
            }else{
                $isSuccess = false;
            }
        }else{
            $errorMessage = null;
            $product = null;
            $isSuccess = false;
        }

        $this->loadView('partitions.backend.header', [
            'data_user' => $this->dataUser,
            'title' => $title
        ]);
        $this->loadView('partitions.backend.sidebar', [
            'data_user' => $this->dataUser
        ]);
        $this->loadView('backend.film.edit', [
            'filmData' => $filmData,
            'countryList' => $countryList,
            'cateList' => $cateList,
            'typeList' => $typeList,
            'statusList' => $statusList,
            'errorMessage' => $errorMessage,
            'product' => $product,
            'isSuccess' => $isSuccess
        ]);
        $this->loadView('partitions.backend.footer', [
            'data_user' => $this->dataUser
        ]);
    }

    public function delete() {
        $idFilm = isset($_GET['id']) ? $_GET['id'] : '';

        if($idFilm) {
            $this->filmModel->deleteFilm($idFilm);
        }
        header('Location: ' . DOMAIN . '/?module=backend&controller=film');
    }
}

?>