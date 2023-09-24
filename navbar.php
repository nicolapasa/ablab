 <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">

                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                            <?php

                            if($fotoprofilo!=''){

                            	$src_foto='./'.DIR_UPLOAD.$fotoprofilo;
                            	?>
                            	<img alt="" class="img-circle" src="<?php echo $src_foto;?>" />
                            	<?php
                            }?>


                                <span class="username username-hide-on-mobile"> <?php echo ucwords($nome_loggato);?> </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="index.php?req=admin&subreq=modifica&id_admin=<?php echo $id_loggata;?>">
                                        <i class="icon-user"></i> Profilo </a>
                                </li>
                              	<?php if($livello=='administrator'){?>
                                  <li>
                       <a href="./index.php?req=errori_db">
                        <i class="icon-lock"></i>
                       Elenco errori </a>
                       </li>
				                    <li>
									<a href="./index.php?req=admin&subreq=offline">
									 <i class="icon-lock"></i>
									Metti offline/online</a>
									</li>

			                                <?php }?>
                                <li>
                                    <a href="logout.php">
                                        <i class="icon-key"></i>Esci </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->

                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
