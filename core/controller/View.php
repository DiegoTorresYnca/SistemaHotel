<?php


// 13 de Abril del 2014
// View.php
// @brief Una vista corresponde a cada componente visual dentro de un modulo.

class View {
	/**
	* @function load
	* @brief la funcion load carga una vista correspondiente a un modulo
	**/	
	public static function load($view){
		// Module::$module;
		if(!isset($_GET['view'])){
			if(Core::$root==""){
				include "core/app/view/".$view."-view.php";
			}else if(Core::$root=="admin/"){
				include "core/app/".Core::$theme."/view/".$view."-view.php";				
			}
		}else{


			if(View::isValid()){
				$url ="";
			if(Core::$root==""){
			$url = "core/app/view/".$_GET['view']."-view.php";
			}else if(Core::$root=="admin/"){
			$url = "core/app/".Core::$theme."/view/".$_GET['view']."-view.php";				
			}
				include $url;				
			}else{
				View::Error('<div class="nk-content ">
				<div class="nk-block nk-block-middle wide-md mx-auto">
					<div class="nk-block-content nk-error-ld text-center">
						<img class="nk-error-gfx" src="assets/images/error-404.svg" alt="">
						<div class="wide-xs mx-auto">
							<h3 class="nk-error-title">¡Ups! Porque estas aqui</h3>
							<p class="nk-error-text">Sentimos mucho las molestias. Parece que estás intentando acceder a una página que ha sido eliminada o que nunca existió.</p>
							<a href="/" class="btn btn-lg btn-primary mt-2">Inicio</a>
						</div>
					</div>
				</div><!-- .nk-block -->
			</div>');
			}



		}
	}

	/**
	* @function isValid
	* @brief valida la existencia de una vista
	**/	
	public static function isValid(){
		$valid=false;
		if(isset($_GET["view"])){
			$url ="";
			if(Core::$root==""){
			$url = "core/app/view/".$_GET['view']."-view.php";
			}else if(Core::$root=="admin/"){
			$url = "core/app/".Core::$theme."/view/".$_GET['view']."-view.php";				
			}
			if(file_exists($file = $url)){
				$valid = true;
			}
		}
		return $valid;
	}

	public static function Error($message){
		print $message;
	}

}



?>