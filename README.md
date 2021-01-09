[Karışık Depoo](https://t.me/karisikdepooyazilim)
# Micro Framework

### Kurulum

1. Projenin klasörünü oluşturun. ör: deneme-framework

Bunlar gerekli değil ama git ile clonelamanızı tavsiye ederim

2. Git'i indirin [Git'in sitesine git](https://git-scm.com/)

3. Git'i kurun kurulum aşamasında path e eklemeyi unutmayın

4. Projenin klasöründe terminal ya da uç birim, cmd vs yani consoleunuzu açın ve projenin dizinine gidin.
 
```sh 
git clone https://github.com/omerfarukbicer0446/framework
``` 
bunu yapıştırın indirme tamamlanmasını bekleyin.

5. İndirme bittikten sonra Linux,Windows ve MacOS için `cd framework` bunu elle de yapabilirsiniz sizin tercihiniz.

6. framework klasörüne gittikten sonra `composer install` yaparak gerekli tüm kütüphaneleri indirebilirseniz

NOT: Eğer composer.json dosyasını sildiyseniz
```sh 
1. composer require vlucas/phpdotenv
2. composer require jenssegers/blade
``` 
yukardakileri sırasıyla kurunuz ya da sırası fark etmez :)

artık her şey hazır son aşama .env dosyasını kendinize göre doldurun ve artık frameworkten hiç bir hata almazsınız.

### Micro Framework'un Micro Dökümantasyonu

#### Controllers/Models/Views yönetimi

Yeni bir route oluşturma public/web.php ye girmelisiniz

```php
$router->get('/merhaba', function(){
    echo 'Merhaba dünya';
});
```

Yeni bir view oluşturma:

yukardada yaptığımız gibi

```php
$router->get('/merhaba-yeni', function(){
    echo 'Merhaba dünya';
});
```

bu kodu aynen yeni bir route oluşturuyoruz ve Merhaba dünya yazdıran yere 

```php
Route::view('merhaba'); // app/views/merhaba.blade.php adında dosya arar

// view in içerisine değer göndermek için
Route::view('merhaba', ['title' => 'merhaba']);
```

ve son hali şöyle olmalıdır.
```php
$router->get('/merhaba-yeni', function(){
    Route::view('merhaba');
});
```

Controller oluşturma.

```php
Route::controller('merhaba@dunya');
// Bu şekilde kullanırsanız app/controllers/merhaba.php den merhaba classının içindeki dunya fonksiyonunu çalıştıracaktır.
Route::controller('yeni-merhaba');
// Bu şekilde kullanırsanız app/controllers/yeni-merhaba.php den yeni-merhaba classının içindeki index fonksiyonunu çalıştıracaktır.

// controller a değer göndermek için
Route::controller('merhaba@dunya', ['title' => 'merhaba']);
```

Model oluşturma pek sağlıklı çalışmıyor ama düzelcektir çalışma mantığı controller ile aynıdır denemek isteyen denesin :)

#### 404 error page

`core/static/404.php` yi kendinize göre istediğiniz gibi yapın

#### Html e link ile dosya çağırma ve script ile de

style ve script dosyalarını public klasörü altında dilediğiniz gibi tutabilirsiniz. ve resimlerinizde orada olabilir :)

```html
<!-- link -->
<link href="public/stylesheets/*" rel="stylesheet">
<!-- images -->
<img src="public/images/*">
<!-- script -->
<script src="public/scripts/*">
```

#### Blade

Gerekli basit işlemler
```php
{{ $x }} // değişkenin değerini yazar

{{-- Yorum satırı --}} // Yorum satırı olur

@if($x == $x)
    <p>Hello World</p>
@endif // Php deki if blokları için
```

Switch case yapısı 

```php
@switch($i)
    @case(1)
        First case...
        @break

    @case(2)
        Second case...
        @break

    @default
        Default case...
@endswitch
```

Döngüler 

```php
@for ($i = 0; $i < 10; $i++)
    The current value is {{ $i }}
@endfor

@foreach ($users as $user)
    <p>This is user {{ $user->id }}</p>
@endforeach

@forelse ($users as $user)
    <li>{{ $user->name }}</li>
@empty
    <p>No users</p>
@endforelse

@while (true)
    <p>I m looping forever.</p>
@endwhile
```

İnclude

```php
@include('welcome')
```

Daha detaylı dökümantasyon için [Laravel'git](https://laravel.com/docs/8.x/blade)


[Karışık Depoo](https://t.me/karisikdepooyazilim)
