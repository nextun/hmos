<ul class="nav" id="side-menu">

                        <li>
                            <a href="<?=base_url('dashboard');?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="<?=base_url('tokens');?>"><i class="fa fa-folder-open-o fa-fw"></i> Tokens </a>

                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?=base_url('reminder');?>"><i class="fa  fa-clock-o fa-fw"></i> Reminders</a>
                        </li>
                        <?php if($this->session->userdata('usertype') == 'admin' || $this->session->userdata('usertype') == 'doctor'){ ?>
                        <li>
                            <a href="<?=base_url('patient');?>"><i class="fa fa-user fa-fw"></i> Patient<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="<?=base_url('patient');?>"> List</a>
                                </li>
                                <li>
                                    <a href="<?=base_url('patient/add/');?>">Add New</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="<?=base_url('doctor');?>"><i class="fa fa-user fa-fw"></i> Doctors<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="<?=base_url('doctor');?>"> List</a>
                                </li>
                                <li>
                                    <a href="<?=base_url('doctor/add/');?>">Add New</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Nurses<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                                                <li>
                                                <a href="<?=base_url('nurse');?>">List</a>
                                                </li>
                                                <li>
                                                <a href="<?=base_url('nurse/add');?>">Add</a>
                                                </li>
                        </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Settings<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>
                                     <a href="#">Ward<span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li>
                                                    <a href="<?=base_url('ward');?>">List</a>
                                                </li>
                                                <li>
                                                    <a href="<?=base_url('ward/add');?>">Add</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">Bed <span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li>
                                                    <a href="<?=base_url('bed');?>">List</a>
                                                </li>
                                                <li>
                                                    <a href="<?=base_url('bed/add');?>">Add</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                                <a href="#"> Drugs<span class="fa arrow"></span></a>
                                             <ul class="nav nav-third-level">
                                             <li>
                                             <a href="<?=base_url('drugs');?>">List</a>
                                             </li>
                                             <li>
                                             <a href="<?=base_url('drugs/add');?>">Add</a>
                                             </li>
                                             </ul>
                                        </li>
                                        <li>
                                                <a href="#"> Stock<span class="fa arrow"></span></a>
                                             <ul class="nav nav-third-level">
                                             <li>
                                             <a href="<?=base_url('stock');?>">Ward List</a>
                                             </li>
                                             <li>
                                             <a href="<?=base_url('stock/add');?>">Add</a>
                                             </li>
                                             </ul>
                                        </li>
                                        <li>
                                                <a href="#"> Nurse Ward<span class="fa arrow"></span></a>
                                             <ul class="nav nav-third-level">
                                             <li>
                                             <a href="<?=base_url('nurseward');?>">List</a>
                                             </li>
                                             <li>
                                             <a href="<?=base_url('nurseward/add');?>">Set</a>
                                             </li>
                                             </ul>
                                        </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php } ?>

                    </ul>
