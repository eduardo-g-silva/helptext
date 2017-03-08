# Yii2 User Extended
Yii2 User Extended to extend Yii2 User by Dektrium: https://github.com/dektrium/yii2-user

This is not an standalone module to manage users but a module to extend Yii2 User extension.

Installation
-----------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require cinghie/yii2-user-extended "*"
```

or add this line to the require section of your `composer.json` file.

```
"cinghie/yii2-user-extended": "*"
```

Configuration
-----------------

### 1. Images folder

Copy img folder to your webroot

### 2. Update yii2 user database schema

Make sure that you have properly configured `db` application component
and run the following command:
```
$ php yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
```

### 3. Add Yii2 RBAC migrations 

```
$ php yii migrate/up --migrationPath=@yii/rbac/migrations
```

### 4. Update yii2 user extended database schema

```
$ php yii migrate/up --migrationPath=@vendor/cinghie/yii2-user-extended/migrations
```

### 5. Set configuration file

Set on your configuration file, in modules section

```
'modules' =>  [
	// Yii2 RBAC
	'rbac' => [
        	'class' => 'dektrium\rbac\Module',
    	],
	// Yii2 User
        'user' => [
                'class' => 'dektrium\user\Module',
                // Yii2 User Controllers Overrides
				'controllerMap' => [
					'admin' => 'cinghie\yii2userextended\controllers\AdminController',
					'settings' => 'cinghie\yii2userextended\controllers\SettingsController',
				],
				// Yii2 User Models Overrides
				'modelMap' => [
					'RegistrationForm' => 'cinghie\yii2userextended\models\RegistrationForm',
					'Profile'          => 'cinghie\yii2userextended\models\Profile',
					'SettingsForm'     => 'cinghie\yii2userextended\models\SettingsForm',
					'User'             => 'cinghie\yii2userextended\models\User',
				],
        ],
        // Yii2 User Extended
		'userextended' => [
            'class' => 'cinghie\yii2userextended\Module',
            'avatarPath' => '@webroot/img/users/', // Path to your avatar files
            'avatarURL'  => '@web/img/users/', // Url to your avatar files
			'showTitles' => true, // Set false in adminLTE
        ],
]
```

and in components section

```
'components' =>  [
        'view' => [
                'theme' => [
                        'pathMap' => [
								'@dektrium/rbac/views' => '@vendor/cinghie/yii2-user-extended/views',
                                '@dektrium/user/views' => '@vendor/cinghie/yii2-user-extended/views',
                        ],
                ],
        ],
]
```

If you have a Yii2 App Advanced add in Yii2 User Module config

```
'modules' =>  [
        'user' => [
            'class' => 'dektrium\user\Module',
            // restrict access to recovery and registration controllers from backend
            'as backend' => 'cinghie\yii2userextended\filters\BackendFilter',
            // Settings
            'enableRegistration' => false,
        ],
],		
```

### 6. Set captcha in Controller

in your SiteController set in actions() function

```
'captcha' => [
        'class' => 'yii\captcha\CaptchaAction',
        'minLength' => 6,
        'maxLength' => 6
],
```

Features
-----------------

Add new fields to user profile
<ul>
  <li>firstname</li>
  <li>lastname</li>
  <li>name (firstname + lastname)</li>  
  <li>birthday</li>
  <li>terms</li>
  <li>captcha</li>
  <li>avatar</li>  
  <ol>
	<li>The avatar can be uploaded</li>
	<li>The avatar can be updated</li>
	<li>On update avatar old image was deleted</li>
  </ol>
</ul>


Changelog
-----------------

<ul>
  <li>Version 0.5.8 - Fixing loadAttributes()</li>
  <li>Version 0.5.7 - Adding enable/disable button in user admin</li>  
  <li>Version 0.5.6 - Adding function to get User Rules from userid</li>
  <li>Version 0.5.5 - Fixing registration captcha</li>
  <li>Version 0.5.4 - Fixing javascript error, adding Backend Filter</li>
  <li>Version 0.5.3 - Improve security</li>
  <li>Version 0.5.2 - Adding Login view for AdminLTE Template</li>
  <li>Version 0.5.1 - Minor Update</li>
  <li>Version 0.5.0 - Manage Users, Roles, Permissions</li>
  <li>Version 0.4.0 - Adding migrations</li>
  <li>Version 0.3.8 - Fixing upload on avatar not set</li>
  <li>Version 0.3.7 - Fixing Avatar default image</li>
  <li>Version 0.3.6 - Adding Avatar Path and Url params to the module</li>
  <li>Version 0.3.5 - Update version</li>
  <li>Version 0.3.4 - Fixing deleting avatar</li>
  <li>Version 0.3.3 - Update version</li>
  <li>Version 0.3.2 - Delete old avatar on updating</li>
  <li>Version 0.3.1 - Update Avatar</li>
  <li>Version 0.3.0 - Adding Avatar</li>
  <li>Version 0.2.1 - Adding Captcha</li>
  <li>Version 0.2.0 - Fixed Bugs</li>
  <li>Version 0.1.5 - Fixing register view, Adding Birthday Field</li>
  <li>Version 0.1.4 - Fixed Bugs</li>
  <li>Version 0.1.3 - Fix User Namespace</li>
  <li>Version 0.1.2 - Fixed Extension</li>
  <li>Version 0.1.1 - Update Composer</li>
  <li>Version 0.1.0 - Initial Release</li>
</ul>
