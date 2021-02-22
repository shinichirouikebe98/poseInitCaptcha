<h1>この作品に関しての説明：</h1>
<p>この作品は自動化攻撃プログラムによるSPAMが大きな社会問題となって、これを阻止するために人間識別技術CAPTCHAと言う技術が誕生しているが自動化攻撃プログラムも進化している。自動化攻撃プログラムによるSPAMを対処する、機械学習による姿勢推定を適用したCaptchaの実装と検証が目的となっている作品です。</p>

キーワード:姿勢推定、PoseNet、CAPTCHA、機械学習、チューリングテスト

<h3>実装する際に使用して技術：</h3>
プログラミング言語：
<ul>
    <li>HTML</li>
    <li>CSS</li>
    <li>PHP</li>
    <li>Javascript</li>
</ul>
データベースに関わる言語：
<ul>
    <li><a href="">MySql</a></li>
</ul>
ライブラリーやフレームワーク：
<ul>
    <li><a href="https://www.tensorflow.org/lite/models/pose_estimation/overview">Posenet</a></li>
    <li><a href="https://learn.ml5js.org/">ml5.js</a></li>
    <li><a href="https://p5js.org/">p5.js</a></li>
    <li><a href="https://laravel.com/">php (Laravel)</a></li>
</ul>
<h3>仕組み：</h3>
<ul>
    <li>データの記録</li>
    POSENETと言われるWebブラウザでリアルタイムに人間の姿勢を推定できる機械学習モデルを基に「ポーズ」データの記録を行いう。POSENETの役割としては、WEBカメラから入力された動画を分析し人間の32箇所の関節を検知して座標として表す。チューリングテストに使用するポーズに対する関節の座標データを記録し,そのポーズに対する座標データの名前を付ける。
    <li>データの学習</li>
    TensorFlow.jsのインターフェースとして誕生した、より初心者向けのML5.jsと言うJavaScriptベース機械学習ライブラリーを利用する。ニューラルネットワークを作成し、ポーズデータの記録から得たデータに基づいてポーズのモデル学習を行う。
    <li>姿勢識別</li>
    POSENETと言われるWebブラウザでリアルタイムに人間の姿勢を推定できる機械学習モデルとML５.jsで作成しポーズデータを学習済みのモデルを基に「ポーズ」の識別を行う。
    <li>チャレンジテスト</li>
    テスト方法としては応答者にチャレンジとして出題した姿勢をやってもらう。出題する姿勢のチャレンジ問題はランダムで出題される。WEBカメラに向かって１0秒間出題された姿勢を維持してもらう。１0秒間リアルタイムで得た応答者の姿勢データを学習したモデルで識別し、出題された姿勢と照らし合わせる。１0秒の間８割が出題された姿勢と応答者がカメラに向かってやった姿勢が一致すれば合格とする。
</ul>




<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
