					<ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler"> </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                          <li class="heading">
                            <h4 class="uppercase font-purple-studio bold"> <?php echo $nome_loggato;?></h4>
                        </li>

                           <li class="nav-item">
                            <a href="./index.php" class="nav-link">
                                <i class=" icon-home"></i>
                                <span class="title">HOME</span>

                            </a>
							</li>
							<li class="nav-item">
                                    <a href="index.php?req=admin&subreq=modifica&id_admin=<?php echo $id_loggata;?>">
                                        <i class="icon-user"></i> Profilo </a>
                                </li>
                       <li class="nav-item">
                            <a href="./logout.php" class="nav-link">
                                <i class=" icon-logout"></i>
                                <span class="title">Esci</span>

                            </a>
							</li>
                    </ul>

                   <div class="socials">
				  	 <img src="./img/whatsapp_icon.webp" class="img-circle" >
					 <p>3896609832</p>
				   </div>
				   <div class="socials">
				  	 <img src="./img/telephone.png" class="img-circle" >
					 <p>0187626259</p>
				   </div>

					<div id="menu-logo">
						<span>AbLab</span>

					</div>

					<?php 

if($livello!='service' and $livello!='referti'){
?>
					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-custom text-center">
							Brochure Ablab<br>
							<a target="_blank" class="btn btn-primary" href="./doc/brochure_2023.pdf">
							Apri
							</a>
							</div>
						</div>
					<div class="col-md-12">
					<div class="alert alert-custom text-center">
					Consulta il nuovo listino 2023<br>
					<a target="_blank" class="btn btn-primary" href="./doc/listino_2023.pdf">
					Apri
					</a>
						</div>
                        </div>
												<div class="col-md-12">
												<div class="alert alert-custom text-center">
												Fornitura materiale di consumo<br>
												<a target="_blank" class="btn btn-primary" href="./doc/AbLab_web_Forniture2022.pdf">
												Apri
												</a>
													</div>
													</div>
												<div class="col-md-12">
												<div class="alert alert-custom2 text-center">
												Corrieri convenzionati<br>
												<a target="_blank" class="btn btn-primary" href="./doc/AbLab_web_Corrieri2022.pdf">
												Apri
												</a>
													</div>
													</div>
												<div class="col-md-12">
												<div class="alert alert-custom text-center">
												Pannello antibiotici<br>
												<a target="_blank" class="btn btn-primary" href="./doc/AbLab_web_PannelloAntibiotici2022.pdf">
												Apri
												</a>
													</div>
										</div>
					</div>
					<?php }?>
				<?php 

if($livello=='service'){
?>
<div class="row">
						<div class="col-md-12">
							<div class="alert alert-custom text-center">
							Consulta il nuovo listino 2022<br>
							<a target="_blank" class="btn btn-primary" href="./doc/AbLab_Listino_Service.pdf">
							Apri
							</a>
							</div>
						</div>
</div>
	<?php }?>
				<?php 
