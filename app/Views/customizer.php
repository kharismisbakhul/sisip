<!-- customizer Panel -->
    <!-- ============================================================== -->
    <aside class="customizer">
        <a href="javascript:void(0)" class="service-panel-toggle">
            <i class="icon-Coffee-2"></i>
        </a>
        <div class="customizer-body">
            <ul class="nav customizer-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#chat" role="tab
                                   " aria-controls="chat" aria-selected="false">
                        <i class="mdi mdi-message-reply font-20"></i>
                    </a>
                </li>

            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- Tab 2 -->
                <div class="tab-pane fade show active" id="chat" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <ul class="mailbox list-style-none m-t-20">
                        <li>
                            <div class="message-center chat-scroll">
                                <?php foreach ($chat as $c) :?>
                                <a href="#" class="message-item ">
                                    <span class="user-img">
                                        <img src="<?= base_url($c['foto_profil'])?>" alt="user" class="rounded-circle">
                                        <span class="profile-status online pull-right"></span>
                                    </span>
                                    <div class="mail-contnet">
                                        <h5 class="message-title"><?=$c['nama']?></h5>
                                        <span class="mail-desc"><?=$c['pesan']?></span>
                                        <span class="time"><?=$c['tanggal'].'-'.$c['waktu']?></span>
                                    </div>
                                    
                                </a>
                                <?php endforeach?>
                                <form action="<?= base_url('/staff/tambahChat')?>" method="post">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <input type="text" data-user-id="1" placeholder="Type &amp; Enter" class="form-control message-bottom" name="pesan">
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="submit" class="btn btn-secondary">+</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- Message -->
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- End Tab 2 -->
            </div>
        </div>
    </aside>