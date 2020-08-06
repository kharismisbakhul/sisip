<!-- customizer Panel -->
    <!-- ============================================================== -->
    <aside class="customizer">
        <a href="javascript:void(0)" class="service-panel-toggle">
            <i class="icon-Mail"></i>
        </a>
        <div class="customizer-body">
            <ul class="nav customizer-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" id="pills-profile-tab" data-toggle="pill" href="#chat" role="tab
                                   " aria-controls="chat" aria-selected="false">
                        <i class="mdi mdi-message-reply font-20"></i>
                    </a>
                </li>

            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- Tab 2 -->
                <div class="tab-pane fade show active" id="chat" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <h4 class="card-title ml-3 mt-3">Chat Box</h4>
                    <ul class="mailbox list-style-none m-t-20">
                        <li>
                            <div class="message-center chat-scroll">
                            <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="chat-box" style="height: 300px;">
                                    <!--chat Row -->
                                    <ul class="chat-list scrollable position-relative" id="list-chat-box">
                                        <!--chat Row -->
                                        <?php foreach ($chat as $c) :?>
                                        <?php if($c['nama'] == session('nama')){?>
                                            <li class="odd chat-item">
                                            <div class="chat-content">
                                                <div class="box bg-light-inverse"><?=$c['pesan']?></div>
                                                <br>
                                            </div>
                                            <div class="chat-time"><?=$c['tanggal'].' '.$c['waktu']?></div>
                                        </li>
                                        <?php }else{?>
                                            <li class="chat-item">
                                            <div class="chat-img">
                                                <img src="<?= base_url($c['foto_profil'])?>" alt="user">
                                            </div>
                                            <div class="chat-content">
                                                <h6 class="font-medium"><?=$c['nama']?></h6>
                                                <div class="box bg-light-info"><?=$c['pesan']?></div>
                                            </div>
                                            <div class="chat-time"><?=$c['tanggal'].' '.$c['waktu']?></div>
                                        </li>
                                        <?php }?>
                                        
                                        <?php endforeach?>
                                        <!--chat Row -->
                                        
                                    </ul>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card">
                        <div class="card-body border-top">
                                <div class="row">
                                        <div class="input-field m-t-0 m-b-0">
                                            <input type="hidden" name="chat-username" value="<?= $user['no_induk']?>" id="chat-username">
                                            <textarea type="text" id="chat-masuk" placeholder="Masukkan pesan..." class="form-control
                                    border-0" name="pesan-chat"></textarea>
                                            <i class="fas fa-paper-plane btn-circle btn-lg btn-cyan float-right text-white" id="kirim-chat"></i>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                <!-- Message -->
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- End Tab 2 -->
            </div>
        </div>
    </aside>