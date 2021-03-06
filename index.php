<?php

	namespace MyCompany\Ecomm;

	require("config.php");
	
	// comment on this one a bit
	// define('Q_FRAME_GET_ID_TYPE', "http://www.omiframe.com/API/types/");
	
	// include the frame
	require_once(OmiWebSite_Frame_Path);
	
	// include a module if needed, modules may also have a "include.php" script that will be included now
	// \QAutoload::LoadModule("../../../../frame/modules/common/");
	
	// set your code folder as the `running folder`
	\QAutoload::AddMainFolder(Q_RUNNING_PATH."code/");
	
	// only if you need to run development mode, remove or comment this line in production
	ini_set('memory_limit', '256M');
	
	// Put your IP instead of "default" if you are not on the same network with the web server
	// EnableDevelopmentMode() will only execute if the conditions are satisfied
	// You may comment out this line in production
	// Setting the second parameter to true it will force a full resync
	\QAutoload::EnableDevelopmentMode(OmiWebSite_DevModelIp, OmiWebSite_FullResync);
	
	// connect to the SQL server
	$mysql = new \QMySqlStorage("sql", "localhost", MyProject_MysqlUser, MyProject_MysqlPass, MyProject_MysqlDb, 3306);
	$mysql->connect();
	
	// we set the $mysql object as the main storage for our APP
	\QApp::SetStorage($mysql);
	// if we are in development mode, we want to let the frame to autosync the DB structure
	\QApp::AutoSyncDbStructure();
	// sets the app's main model
	\QApp::SetDataClass("MyCompany\\Ecomm\\Model\\AppModel");
	
	// now run a controller
	\QApp::Run(new AppController());
	
