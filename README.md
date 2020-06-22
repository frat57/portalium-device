# Kurulum Aşamaları 
  
  Sırasıyla aşağıdaki yazılımlar kurulmalı ve github token üretilmelidir.
  
 1. <a href="https://www.virtualbox.org/wiki/Downloads">VirtualBox</a>
 2. <a href="https://www.vagrantup.com/downloads.html">Vagrant</a>
 3. <a href="https://www.git-scm.com/">Git</a>
 4. <a href="https://github.com/settings/tokens">Github Token</a>
 5. Yönetici yetkileriyle terminal (komut satırı) açılarak aşağıdaki direktifler uygulanmalıdır.
 
 
 `vagrant plugin install vagrant-hostmanager`
 
 `git clone https://github.com/kouosl/portalium-kickstarter.git portalium`
 
 `git clone https://github.com/kouosl/vagrant-portalium.git vagrant-portalium`
 

6.Aşağıdaki dizinde bulunan vagrant-local.example.yml dosyasının vagrant-local.yml adıyla kopyası oluşturulmalıdır.

  `@vagrant-portal/config`
  
7.GitHub api tokenı vagrant-local.yml dosyasında aşağıdaki şekilde tanımlanmalıdır.
`
....
github_token: qy6uuqııq8ııqooqwuw78qııqowksjjeoow9oowlw
....
`

8.Vagrant makina çalıştırılarak kurulum başlatlır. Komut vagrant-portal dizininin içinde çalıştırılmalıdır.

`vagrant up`

Vagrant makina kurulumu tamamlandıktan sonra aşağıdaki bağlantılardan uygulamaya erişilebilir.

* frontend=http://portalium/
* backend: http://portalium/admin
* api: http://portalium/api

Terminal'den (komut satırı) sanal makinaya SSH erişimi için;

`vagrant ssh`

Hariçi bir programla (putty vb.) ssh bağlantısı için bilgiler;

* ip : 192.168.83.137
* user : vagrant
* password : vagrant

Private key ile bağlatı için;

`ssh -i .vagrant/machines/portalium/virtualbox/private_key vagrant@portalium`

# Modülün Entegrasyonu

Sanal Makine ile bağlantı sağlandıktan sonra sırasıyla şu aşamalar yapılmalıdır.

1. Git açılarak `git clone https://github.com/frat57/portalium-device.git`yazılarak dosyanın o klasöre çekilmesi

2. Portalium içerisinde ki composer.json dosyasına girerek repositories altına 
  `{
            "type": "vcs",
            "url": "https://github.com/frat57/portalium-device.git"
        },`
        
        
3. portalium/api/main.php  module içerisine 

   `'device' => [
            'class' => 'portalium\device\Module'
        ],`
        
4. portalium/backend/main.php  module içerisine

    ` 'device' => [
            'class' => 'portalium\device\Module'
        ],`
        
        
5. portalium/frontend/main.php module içerisine

     `'device' => [
            'class' => 'portalium\device\Module'
        ],`
        
        
 İşlemleri yapıldığında aşağıdaki işlemler sırasıyla yapılmalıdır.
 
 Sanal Makineye bağlanma
 * `vagrant ssh`
 * `cd var/www/portalium`
 * `composer update` Bu komutla birlikte gelen seçeneğe `y` dedikten sonra modülümüzün entegrasyonunu gerçekleştirmiş oluyoruz.
