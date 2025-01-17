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
    <li><a href="https://getbootstrap.com/docs/5.0/getting-started/introduction/">Bootstrap</a></li>
    <li><a href="https://laravel.com/">php (Laravel)</a></li>
</ul>
<h3>CAPTCHA仕組み：</h3>
<ul>
    <li>データの記録</li>
    POSENETと言われるWebブラウザでリアルタイムに人間の姿勢を推定できる機械学習モデルを基に「ポーズ」データの記録を行いう。POSENETの役割としては、WEBカメラから入力された動画を分析し人間の17箇所の関節を検知して座標として表す。チューリングテストに使用するポーズに対する関節の座標データを記録し,そのポーズに対する座標データの名前を付ける。
    <li>データの学習</li>
    TensorFlow.jsのインターフェースとして誕生した、より初心者向けのML5.jsと言うJavaScriptベース機械学習ライブラリーを利用する。ニューラルネットワークを作成し、ポーズデータの記録から得たデータに基づいてポーズのモデル学習を行う。
    <li>姿勢識別</li>
    POSENETと言われるWebブラウザでリアルタイムに人間の姿勢を推定できる機械学習モデルとML５.jsで作成しポーズデータを学習済みのモデルを基に「ポーズ」の識別を行う。
    <li>チャレンジテスト</li>
    テスト方法としては応答者にチャレンジとして出題した姿勢をやってもらう。出題する姿勢のチャレンジ問題はランダムで出題される。WEBカメラに向かって１0秒間出題された姿勢を維持してもらう。１0秒間リアルタイムで得た応答者の姿勢データを学習したモデルで識別し、出題された姿勢と照らし合わせる。１0秒の間８割が出題された姿勢と応答者がカメラに向かってやった姿勢が一致すれば合格とする。
</ul>

<h2>参考動画</h2>
<ul>
    <li>機械学習による姿勢推定を適用したCAPTCHAのざっくり概要紹介動画：https://youtu.be/c0TbbeZCXMw</li>
    <li>機械学習による姿勢推定を適用したCAPTCHAの構成設定管理システムの紹介動画：https://youtu.be/ZmOTZnNb4IE</li>
    <li>テスト：https://user-images.githubusercontent.com/57369264/109387203-54f45300-7943-11eb-8c5c-17bbad61efc2.mp4</li>
</ul>








