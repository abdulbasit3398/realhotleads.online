<?php

namespace App\Http\Controllers;

use cPanel;
use SoapClient;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('dashboard');
    }
    
    public function test()
    {
        $cpanel = new \myPHPnotes\cPanel('outsbjhk','Wa4/listaccts?login', '66.29.143.188');
        $parameters = [];
        $response = $cpanel->uapi(
            'Email',
            'add_pop',
            array (
                'email' => 'usertest3216',
                'password' => '123456luggage',
                'domain' => 'app.automatedcontactgenerator.com',
            )
        );
        if ($response->status) {
            $data = $response->data;
            $data = str_replace("+","@",$data);
             dump($data);

        }
        else{
            dump($response->errors);
        }
        dd($response);

        

        $antispam = false; 

        // cPanel info
        $cpuser = 'outsbjhk'; // cPanel username
        $cppass = 'Wa4/listaccts?login'; // cPanel password
        $cpdomain = '66.29.143.188'; // cPanel domain or IP
        $cpskin = 'paper_lantern';  // cPanel skin. Mostly x or x2. 
        // See following URL to know how to determine your cPanel skin
        // http://www.zubrag.com/articles/determine-cpanel-skin.php

        // Default email info for new email accounts
        // These will only be used if not passed via URL
        $epass = 'hispassword'; // email password
        $edomain = 'app.automatedcontactgenerator.com'; // email domain (usually same as cPanel domain above)
        $equota = 20; // amount of space in megabytes

        ############################################################### 
        # END OF SETTINGS
        ############################################################### 

        function getVar($name, $def = '') {
          if (isset($_REQUEST[$name]))
            return $_REQUEST[$name];
          else 
            return $def;
        }

        // check if overrides passed
        $euser = getVar('user', '');
        $epass = getVar('pass', $epass);
        $edomain = getVar('domain', $edomain);
        $equota = getVar('quota', $equota);

        $msg = '';

        if (!empty($euser))
        while(true) {

          if ($antispam) {
            @session_start(); // start session if not started yet
            if ($_SESSION['AntiSpamImage'] != $_REQUEST['anti_spam_code']) {
              // set antispam string to something random, in order to avoid reusing it once again
              $_SESSION['AntiSpamImage'] = rand(1,9999999);
          
              // let user know incorrect code entered
              $msg = '<h2>Incorrect antispam code entered.</h2>';
              break;
            }
            else {
              // set antispam string to something random, in order to avoid reusing it once again
              $_SESSION['AntiSpamImage'] = rand(1,9999999);
            }
          }

          // Create email account
          $f = fopen ("http://$cpuser:$cppass@$cpdomain:2083/frontend/$cpskin/mail/doaddpop.html?email=$euser&domain=$edomain&password=$epass&quota=$equota", "r");
          if (!$f) {
            $msg = 'Cannot create email account. Possible reasons: "fopen" function allowed on your server, PHP is running in SAFE mode';
            break;
          }

          $msg = "<h2>Email account {$euser}@{$edomain} created.</h2>";

          // Check result
          while (!feof ($f)) {
            $line = fgets ($f, 1024);
            if (ereg ("already exists", $line, $out)) {
              $msg = "<h2>Email account {$euser}@{$edomain} already exists.</h2>";
              break;
            }
          }
          @fclose($f);

          break;
      }
        
        return view('test',compact('msg','euser','antispam'));
        // Create a new SOAP client
        $client = new SoapClient('https://ws.cdyne.com/phoneverify/phoneverify.asmx?wsdl');
        
        // Specify required info to send a text message
        $param = array(
          'PhoneNumbers' => array('17575449510', '18009843710','03247763398'),
          'LicenseKey' => '8760a4dd-e40f-4ea1-930e-03e3efcce037'
        );
        
        $result = $client->CheckPhoneNumbers($param);
        
        // View the response from CDYNE
        dd($result);
        
        
    }

    public function test_post(Request $request)
    {
        $antispam = false; 

        // cPanel info
        $cpuser = 'outsbjhk'; // cPanel username
        $cppass = 'Wa4/listaccts?login'; // cPanel password
        $cpdomain = '66.29.143.188'; // cPanel domain or IP
        $cpskin = 'paper_lantern';  // cPanel skin. Mostly x or x2. 
        // See following URL to know how to determine your cPanel skin
        // http://www.zubrag.com/articles/determine-cpanel-skin.php

        // Default email info for new email accounts
        // These will only be used if not passed via URL
        $epass = 'hispassword'; // email password
        $edomain = 'app.automatedcontactgenerator.com'; // email domain (usually same as cPanel domain above)
        $equota = 20; // amount of space in megabytes

        ############################################################### 
        # END OF SETTINGS
        ############################################################### 

        function getVar($name, $def = '') {
          if (isset($_REQUEST[$name]))
            return $_REQUEST[$name];
          else 
            return $def;
        }

        // check if overrides passed
        $euser = getVar('user', '');
        $epass = getVar('pass', $epass);
        $edomain = getVar('domain', $edomain);
        $equota = getVar('quota', $equota);

        $msg = '';

        if (!empty($euser))
        while(true) {

          if ($antispam) {
            @session_start(); // start session if not started yet
            if ($_SESSION['AntiSpamImage'] != $_REQUEST['anti_spam_code']) {
              // set antispam string to something random, in order to avoid reusing it once again
              $_SESSION['AntiSpamImage'] = rand(1,9999999);
          
              // let user know incorrect code entered
              $msg = '<h2>Incorrect antispam code entered.</h2>';
              break;
            }
            else {
              // set antispam string to something random, in order to avoid reusing it once again
              $_SESSION['AntiSpamImage'] = rand(1,9999999);
            }
          }

          // Create email account
          $f = fopen ("http://$cpuser:$cppass@$cpdomain:2083/frontend/$cpskin/mail/doaddpop.html?email=$euser&domain=$edomain&password=$epass&quota=$equota", "r");
          if (!$f) {
            $msg = 'Cannot create email account. Possible reasons: "fopen" function allowed on your server, PHP is running in SAFE mode';
            break;
          }

          $msg = "<h2>Email account {$euser}@{$edomain} created.</h2>";

          // Check result
          while (!feof ($f)) {
            $line = fgets ($f, 1024);
            if (ereg ("already exists", $line, $out)) {
              $msg = "<h2>Email account {$euser}@{$edomain} already exists.</h2>";
              break;
            }
          }
          @fclose($f);

          break;
      }
    }
}
