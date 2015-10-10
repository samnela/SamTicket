# -*- mode: ruby -*-
#  vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure(2) do |config|
  config.vm.box = "chef/debian-8.0"
#  config.vm.provision :shell, path : "bootstrap.sh"
  
  config.vm.define "ticket" do |ticket|
      ticket.vm.network "private_network" , ip:"10.10.10.10"
      ticket.vm.synced_folder ".", "/var/www/"
      ticket.vm.provision :shell , path: "bootstrap.sh"
  end
end
