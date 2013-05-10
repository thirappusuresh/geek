Installation Guide for Task
===========================

As you might be knowing that there are two ways to install lampp stack, one is directly download lampp stack and use it and the other process is installing apache, mysql and php seperately. I'm writing instructions for both cases.

1. Install Lamp stack on ubuntu(Assuming you are using Ubuntu).
2. Download Yii from http://www.yiiframework.com & rename the folder to yii. Copy Yii framework folder under /opt/lampp/htdocs (or) if you installed apache seperately then copy the same under /var/www.
3. Copy/checkout and keep the code in geek folder, put geek folder under /opt/lampp/htdocs(if you install apache seperately then copy the same under /var/www).
4. Modify index.php under geek folder to point to yii directory. It should be just $yii=dirname(__FILE__).'/../yii/framework/yii.php';
5. Import Database.sql file to mysql database(name it geek).
6. Go to protected/config folder and edit main.php file to connect to database 
  'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=geek',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),

6. Edit params.php to point to the root of the application
	'base_location'=>'/opt/lampp/htdocs', ---if installed lampp stack directly
	'base_location'=>'/var/www/geek', ---if installed seperately

8. Follow this step if you have installed apache seperatly otherwise skip it. Edit /etc/apache2/sites-available/default file to point DocumentRoot /var/www and enable AllowOverride to all so that we can use .htaccess to Rewrite index.php in url

        DocumentRoot /var/www

        <Directory /var/www>
                Options Indexes FollowSymLinks MultiViews
                AllowOverride All
                Order allow,deny
                allow from all
        </Directory>

	enable rewrite mod by running this command in terminal
   	==>  sudo a2enmod rewrite

10. Restart the server.
