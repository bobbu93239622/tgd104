MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=henrychang0202@gmail.com
MAIL_PASSWORD= (密碼)
MAIL_ENCRYPTION=tls
<?PHP
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Validator; //驗證器
use Hash; //雜湊
use Mail; //寄信
use App\Shop\Entity\User; //使用者 Eloquent ORM Model

class UserAuthController extends Controller
{
    //處理註冊資料
    public function signUpProcess()
    {
        //省略
        User::create($input);

        //寄送註冊通知信
        $mail_binding = [
            'name' => $input['name']
        ];

        Mail::send('email.signUpEmailNotification', $mail_binding,
        function($mail) use ($input){
            //收件人
            $mail->to($input['email']);
            //寄件人
            $mail->from('henrychang0202@gmail.com');
            //郵件主旨
            $mail->subject('恭喜註冊Laravel部落格成功!');
        });

        //重新導向到登入頁
        return redirect('/user/auth/sign-in');
    }
}
?>



<h1> 恭喜 {{ $name }} Laravel部落格 註冊成功</h1>