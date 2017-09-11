# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|

  config.vm.box = "debian/jessie64"
  config.vm.provision :shell, path: "bootstrap.sh"

  config.vm.network "private_network", ip: "192.168.50.10"
  config.vm.network "forwarded_port", guest: 5432, host: 5433       # postgres

  config.vm.synced_folder "./", "/vagrant", id: "vagrant-root", :type => "nfs"

end