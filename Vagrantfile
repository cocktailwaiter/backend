Vagrant.configure("2") do |config|
  config.vm.box = "centos/7"

  config.vm.network "private_network", ip: "192.168.33.101"
  config.vm.synced_folder "./", "/vagrant",type: "rsync", rsync__exclude: ".git/",
    :mount_options => ['dmode=777', 'fmode=777']

  config.ssh.insert_key = false
  config.vm.provision :shell, keep_color: true, path: "vagrant_config/provision.sh"
end

###############################
# run to `vagrant rsync-auto` #
###############################
