<?php

class OnlineController
{
	public function get_index ($res)
	{
		dump ($res);
		$page = new MothershipResponsePage ($res->app);

		return $page;
	}

	public function do_publish ($request)
	{
	}
}