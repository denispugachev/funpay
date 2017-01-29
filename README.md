# FunPay test task (Yii2 implementation)

Simple SMS message text parsing application. Made using [Yii2 advanced app template](https://github.com/yiisoft/yii2-app-advanced).

### How to launch app

1. Install virtualbox and vagrant.
2. Prepare project:

    
    git clone https://github.com/denispugachev/funpay.git
    cd funpay/vagrant/config
    cp vagrant-local.example.yml vagrant-local.yml
    
3. Place your GitHub personal API token to vagrant-local.yml 
4. Change directory to project root:

    
    cd yii2-app-advanced
    
    
5. Run commands:
   
    
    vagrant plugin install vagrant-hostmanager
    vagrant up
    
After that you can access application by URL [http://funpay.dev](http://funpay.dev).

Input your SMS message text to textarea and click "Parse" to get results.
        

### Where important code blocks are 

1. SMS message model with parsing methods: [common/models/SmsMessage.php](common/models/SmsMessage.php):
2. JS code: [main/web/js/main.js](main/web/js/main.js)