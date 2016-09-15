<?php
namespace Home\Controller;
use Think\Controller;
class HomeBaseController extends BaseController {
    public function __construct(){
        parent::__construct();
		setLastUrl();
    }

	public function e404(){
		$this->redirect(__DOMAIN__."?m=home&g=e404&error");
	}
}