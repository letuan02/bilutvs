<div class="content__home col l-8 m-12 c-12">

    <!-- content main -->
    <main class="content__main">
        <section class="content__main-film-cover-img" style="background-image: url(<?=$filmData['thumbnail'];?>)">
            <div class="content__main-film-overlay"></div>
            <div class="content__main-film-thumbnail" style="background-image: url(<?=$filmData['poster'];?>);"></div>
            <div class="content__main-film-info-wrap">
                <div class="content__main-film-info">
                    <h2 class="content__main-film-info-name"><?=$filmData['name'];?></h2>
                    <span class="content__main-film-info-real-name"><?=$filmData['real_name'];?></span>
                </div>

                <div class="content__main-film-view">
                    <div class="content__main-film-view-icon">
                        <i class="far fa-heart"></i>
                        <!-- <i class="fas fa-heart"></i> -->
                    </div>
                    <div class="content__main-film-view-qnt">
                        <div class="content__main-film-view-qnt-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <?=number_format($filmData['view'], 0, ',', '.');?>
                    </div>
                </div>
            </div>
        </section>

        <section class="content__main-film-tabs">
            <ul class="content__main-film-tab-list">
                <li class="content__main-film-tab-item">
                    <a href="<?=DOMAIN?>/xem-phim/<?=$filmData['slug'];?>-tap-1" class="content__main-film-tab-link content__main-film-tab-watch-btn">
                        <div class="content__main-film-tab-icon">
                            <i class="fas fa-play"></i>
                        </div>
                        Xem Phim
                    </a>
                </li>
                <li class="content__main-film-tab-item">
                    <a href="" class="content__main-film-tab-link content__main-film-tab-item-btn-listphim">
                        Danh S??ch T???p
                    </a>
                </li>
                <li class="content__main-film-tab-item">
                    <a href="" class="content__main-film-tab-link">
                        Trailer
                    </a>
                </li>
            </ul>

            <div class="content__main-film-tab-action hide-on-mobile-tablet">
                <div class="fb-like" data-href="<?=DOMAIN?>/phim/<?=$filmData['slug'];?>" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="true"></div>
            </div>
        </section>

        <section class="content__player-film-details hidden">
            <div class="content__player-film-details-heading">
                <div class="content__player-film-details-heading-icon">
                    <i class="fas fa-search"></i>
                </div>
                <span class="content__player-film-details-heading-text">T??m t???p nhanh</span>
                <div class="content__player-film-details-heading-icon">
                    <i class="fas fa-angle-down"></i>
                </div>
            </div>

            <div class="content__player-film-search">
                <input type="text" class="content__player-film-search-input" placeholder="Nh???p t??n/ s??? t???p">
            </div>
            <div class="content__player-film-search-result"></div>

            <div class="content__player-film-details-heading">
                <div class="content__player-film-details-heading-icon">
                    <i class="fas fa-tv"></i>
                </div>
                <span class="content__player-film-details-heading-text">Vietsub</span>
                <div class="content__player-film-details-heading-icon">
                    <i class="fas fa-angle-down"></i>
                </div>
            </div>

            <ul class="content__player-film-episodes">
                
                <?php
                    for($i = $filmData['episodeCurrent']; $i > 0; $i--) {
                        echo
                        '
                            <li class="content__player-film-episode">
                                <a href="'.DOMAIN.'/xem-phim/'.$filmData['slug'].'-tap-'.$i.'" title="Xem phim '.$filmData['name'].' T???p '.$i.'" class="content__player-film-episode-link">T???p '.$i.'</a>
                            </li>
                        ';
                    }
                ?>
                
            </ul>
        </section>

        <section class="content__main-film-details-wrap">
            <div class="content__main-film-tag">
                <div class="content__main-film-tag-status content__main-film-tag-status--vip">VIP</div>
                <ul class="content__main-film-tags">
                    <li class="content__main-film-tag-item content__main-film-tag-item-has-sparator">
                        <a href="<?=DOMAIN?>/quoc-gia/<?=$filmData['nation_slug'];?>" class="content__main-film-tag-link"><?=$filmData['nation_name'];?></a>
                    </li>
                    <li class="content__main-film-tag-item content__main-film-tag-item-has-sparator">
                        <a href="<?=DOMAIN?>/nam/<?=$filmData['year'];?>" class="content__main-film-tag-link"><?=$filmData['year'];?></a>
                    </li>
                    <li class="content__main-film-tag-item">
                        <span class="content__main-film-tag-link"><?=$filmData['total_episode'];?> t???p</span>
                    </li>
                </ul>
            </div>

            <div class="content__main-film-trend">
                <label for="" class="content__main-film-trend-label">TOP 10</label>
                <a href="" class="content__main-film-trend-link">
                    #4 tr??n top th???nh h??nh
                </a>
            </div>

            <div class="content__main-film-details">
                <div class="content__main-film-detail">
                    <ul class="content__main-film-detail-list">
                        <li class="content__main-film-detail-item">
                            Tr???ng th??i: <span class="content__main-film-detail-stt">
                                <?php if ($filmData['type_id'] == 1): ?>
                                    <?=$filmData['status_name'];?>
                                <?php elseif ($filmData['total_episode'] === $filmData['episodeCurrent']): ?>
                                    Full <?=$filmData['total_episode'];?>/<?=$filmData['total_episode'];?> Tr???n B???
                                <?php else: ?>
                                    T???p <?=$filmData['episodeCurrent'];?> VIETSUB
                                <?php endif; ?>
                            </span>
                        </li>
                        <li class="content__main-film-detail-item">
                            ?????o di???n:
                            <a href="" class="content__main-film-detail-link">L??u Qu???c Nam</a>,
                            <a href="" class="content__main-film-detail-link">Tri???u L???p Qu??n</a>
                        </li>
                        <li class="content__main-film-detail-item">
                            Di???n vi??n: <a href="" class="content__main-film-detail-link">Th??nh Ngh???</a>,
                            <a href="" class="content__main-film-detail-link">Tr????ng D?? Hi</a>,
                            <a href="" class="content__main-film-detail-link">H??n ?????ng</a>,
                            <a href="" class="content__main-film-detail-link">Tuy??n L???</a>
                        </li>
                        <li class="content__main-film-detail-item">
                            Th??? lo???i:
                            <a href="" class="content__main-film-detail-link"><?=$filmData['cate_name'];?></a>
                        </li>
                        <li class="content__main-film-detail-item">
                            Th???i l?????ng: 45 ph??t
                        </li>
                    </ul>

                    <div class="content__main-film-detail-vote">
                        <span class="content__main-film-detail-vote-average">5.7</span>
                        <div class="content__main-film-detail-action">
                            <span class="content__main-film-detail-act-vote">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </span>
                            <span class="content__main-film-detail-total-vote">
                                <div class="content__main-film-detail-vote-icon">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                1151 l?????t ????nh gi??
                            </span>
                        </div>
                    </div>
                </div>
                <div class="content__main-film-detail">
                    <span class="content__main-film-detail-title">N???I DUNG PHIM</span>
                    <p class="content__main-film-detail-content"><?=$filmData['description'];?></p>
                </div>
            </div>
        </section>

        <section class="content__main-film-note">
            <div class="content__main-film-note-title">
                <div class="content__main-film-note-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <strong class="content__main-film-note-title">Th??ng Tin - L???ch Chi???u</strong>
            </div>

            <span class="content__main-film-note-dessc">
                L???ch Chi???u Phim D??? Qu??n Ca ???????c l??n s??ng 7h-8h t???i h???ng ng??y tr??n BiluTV
            </span>
        </section>

        <section class="content__main-film-comment">
            <div class="fb-comments" data-href="<?=DOMAIN?>/phim/<?=$filmData['slug'];?>" data-width="100%" data-numposts="5"></div>
        </section>
    </main>
    <!-- end content main -->

    <section class="content__films">
        <div class="content__main-heading-wrap">
            <h2 class="content__main-heading-title">Phim li??n quan</h2>
        </div>
        <!-- end heading -->

        <div class="grid content__main-films">
            <div class="row">
                <?php foreach ($filmRelation as $item): ?>
                <div class="col l-3 m-3 c-4">
                    <div class="content__main-film">
                        <a href="<?=DOMAIN?>/phim/<?=$item['slug'];?>" class="content__main-film-link">
                            <div class="content__main-film-img-wrap">
                                <div class="content__main-film-img" style="background-image: url(<?=$item['poster'];?>)"></div>
                                <!-- <label for="" class="content__main-film-status">
                                    <?php if ($item['type_id'] == 1): ?>
                                        <?=$item['status_name'];?>
                                    <?php elseif ($item['total_episode'] === $item['episodeCurrent']): ?>
                                        Full <?=$item['total_episode'];?>/<?=$item['total_episode'];?>
                                    <?php else: ?>
                                        T???p <?=$item['episodeCurrent'];?>
                                    <?php endif; ?>
                                </label> -->
                                <!-- <label for="" class="content__main-film-quality">T???p 10 Thuy???t Minh</label> -->
                                <label for="" class="content__main-film-btn">
                                    <i class="fas fa-play"></i>
                                </label>
                            </div>

                            <div class="content__main-film-info">
                                <p class="content__main-film-name"><?=$item['name'];?></p>
                                <p class="content__main-film-real-name"><?=$item['real_name'];?></p>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="content__films-tags-wrap">
        <div class="content__films-tags">
            <label for="" class="content__films-tag-label">
                <div class="content__films-tag-label-icon">
                    <i class="fas fa-tags"></i>
                </div>
                T??? kh??a:
            </label>
            <ul class="content__films-tag-list">
                <li class="content__films-tag-item">
                    <h3>
                        <a href="<?=DOMAIN?>/tim-kiem/?q=<?=$filmData['name'];?>" class="content__films-tag-link">
                            <div class="content__films-tag-icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <?=$filmData['name'];?>
                        </a>
                    </h3>
                </li>
                <li class="content__films-tag-item">
                    <h3>
                        <a href="<?=DOMAIN?>/tim-kiem/?q=<?=$filmData['real_name'];?>" class="content__films-tag-link">
                            <div class="content__films-tag-icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <?=$filmData['real_name'];?>
                        </a>
                    </h3>
                </li>
                <li class="content__films-tag-item">
                    <h3>
                        <a href="<?=DOMAIN?>/nam/<?=$filmData['year'];?>" class="content__films-tag-link">
                            <div class="content__films-tag-icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <?=$filmData['year'];?>
                        </a>
                    </h3>
                </li>
                <li class="content__films-tag-item">
                    <h3>
                        <a href="" class="content__films-tag-link">
                            <div class="content__films-tag-icon">
                                <i class="fas fa-folder"></i>
                            </div>
                            Phim <?=$filmData['nation_name'];?>
                        </a>
                    </h3>
                </li>
            </ul>
        </div>

        <p class="content__films-tags-text">
            xem phim <?=$filmData['name'];?> viesub, thuy???t minh.
            <?=$filmData['real_name'];?> viesub, Review phim <?=$filmData['name'];?>,
            Spoil phim <?=$filmData['name'];?>, Preview
            phim <?=$filmData['name'];?> , l???ch chi???u phim <?=$filmData['name'];?>.
            xem <?=$filmData['name'];?> vietsub online tap 1,
            tap 2, tap 3, tap 4, phim <?=$filmData['real_name'];?>
            ep 5, ep 6, ep 7, ep 8, ep 9, ep 10, D??? Qu??n
            Ca t???p 11, t???p 12, t???p 13, t???p 14, t???p 15, phim
            <?=$filmData['name'];?> tap 16, tap 17, tap 18, tap 19, tap
            20, xem phim <?=$filmData['name'];?> t???p 21, 23, 24, 25, 26,
            27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38,
            39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50,
            <?=$filmData['name'];?> tap cuoi, <?=$filmData['real_name'];?> vietsub
            tron bo, <?=$filmData['name'];?> subnhanh, <?=$filmData['name'];?> wetv,
            <?=$filmData['name'];?> zingtv, <?=$filmData['name'];?> youtube, <?=$filmData['name'];?> phimmoi.net,
            <?=$filmData['name'];?> phimbathu, vuighe,
            vieon, vn2, fptplay, motphim, phim4400, dongphim,
            vungtv, khoaitv, fullphim, biluhay, phim14, vuviphim,
            phim3s, vkool, hdonline, phim1080, fimfast <?=$filmData['name'];?>
            full, <?=$filmData['real_name'];?> online, <?=$filmData['name'];?> L???ng Ti???ng
        </p>
    </section>
</div>
<script src="<?=DOMAIN?>/Public/frontend/js/filmdetail.js"></script>
<script src="<?=DOMAIN?>/Public/frontend/js/heartfilms.js"></script>
<!-- end -->