<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>
<img src='https://github.com/JasonDontw/laravel/blob/master/blog.gif'>
1.安裝VirtualBox

2.安裝Vagrant

3.下載文件http://download.fsdhub.com/lc-homestead-6.1.1-2018090400.zip

4.在檔案目錄中 lc-homestead-6.1.1-2018090400 執行
  > vagrant box add metadata.json
  導入
  
5.安装 Git

6.使用 Git 下载Homestead：
   > cd ~
   > git clone https://git.coding.net/summerblue/homestead.git Homestead
   
7.初始化 Homestead
   > cd ~/Homestead
   > bash init.sh
   
8.配置Homestead底下的Homestead.yaml
   修改部分
   keys:
    - ~/.ssh/id_rsa
    - ~/.ssh/id_rsa.pub
   folders:
    - map: ~/Code
      to: /home/vagrant/Code
   sites:
    - map: homestead.test
      to: /home/vagrant/Code/Laravel/public
   variables:
    - key: APP_ENV
      value: local
      
9. 創建KEY 
    > ssh-keygen -t rsa -C "your_email@example.com"

10. 新增IP
   到C:\Windows\System32\drivers\etc\hosts
   於檔案底部加上
   192.168.10.10  homestead.test
   
11. project更名為sample移至C:\Users\'username'\Code

12. 於git bash 執行
    > cd ~/Homestead && vagrant up
    > vagrant ssh
13. 進入http://sample.test/即可使用


引用:
環境搭建引用至https://laravel-china.org/docs/laravel-development-environment/5.5/development-environment-macos/937
作者:Summer
