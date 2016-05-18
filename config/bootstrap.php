<?php
/**
 * CakeManager (http://cakemanager.org)
 * Copyright (c) http://cakemanager.org
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) http://cakemanager.org
 * @link          http://cakemanager.org CakeManager Project
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\ORM\TableRegistry;
use Settings\Core\Setting;
use Cake\Event\EventManager;
use CakeAdmin\Event\CakeAdminMailer;
use Notifier\Utility\NotificationManager;

# Plugins
Plugin::load('Utils', []);
Plugin::load('Settings', ['bootstrap' => true, 'routes' => true]);
Plugin::load('Notifier', ['bootstrap' => true, 'routes' => true]);
Plugin::load('Bootstrap', ['bootstrap' => false, 'routes' => false]);


# Configurations
Configure::write('Session.timeout', 4320);
Configure::write('CA.Menu.main', []);
Configure::write('CA.PostTypes', []);
Configure::write('CA.fields', [
    'username' => 'email',
    'password' => 'password'
]);
Configure::write('Settings.Prefixes.CA', 'CakeAdmin');
Configure::write('CA.Models.administrators', 'CakeAdmin.Administrators');

# Basic Settings
Setting::register('App.name', 'CakeAdmin Application');
Setting::register('App.email.name', 'CakeAdmin');
Setting::register('App.email.from', 'cakeadmin@cakeplugins.org');
Configure::write('CA.email.from', [Setting::read('App.email.from') => Setting::read('App.email.name')]);
Configure::write('CA.email.transport', 'default');

# Notification Templates
NotificationManager::instance()->addTemplate('newAdministrator', [
    'title' => 'New administrator has been registered',
    'body' => ':email has been registered as administrator at :created'
]);

# Theming
Configure::write('Settings.Prefixes.LS', 'LightStrap');
Configure::write('CA.theme', null);
Configure::write('CA.viewClass', 'CakeAdmin.CakeAdmin');
Configure::write('CA.layout.default', 'CakeAdmin.default');
Configure::write('CA.layout.login', 'CakeAdmin.login');

# Theming Settings
Setting::register('LS.subtheme', 'Cosmo', [
    'options' => [
        null => __d('LightStrap', 'None'),
        'Cerulean' => 'Cerulean',
        'Cosmo' => 'Cosmo',
        'Cyborg' => 'Cyborg',
        'Darkly' => 'Darkly',
        'Flatly' => 'Flatly',
        'Journal' => 'Journal',
        'Lumen' => 'Lumen',
        'Paper' => 'Paper',
        'Readable' => 'Readable',
        'Simplex' => 'Simplex',
        'Slate' => 'Slate',
        'Spacelab' => 'Spacelab',
        'Superhero' => 'Superhero',
        'United' => 'United',
        'Yeti' => 'Yeti',
    ],
    'type' => 'select'
]);
Setting::register('LS.navbar', 'navbar-default', [
    'options' => [
        'navbar-default' => __('Default'),
        'navbar-inverse' => __('Inverse'),
    ],
    'type' => 'select'
]);
Setting::register('LS.container', 'container', [
    'options' => [
        'container' => __('Fixed'),
        'container-fluid' => __('Fluid'),
    ],
    'type' => 'select'
]);
Configure::write('CA.LightStrap.subtheme', Setting::read('LS.subtheme'));
Configure::write('CA.LightStrap.navbar', Setting::read('LS.navbar'));
Configure::write('CA.LightStrap.container', Setting::read('LS.container'));
