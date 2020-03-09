<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible"content="IE=edge">
<meta name="viewport"content="width=device-width, initial-scale=1">

<title>404 Page Not Found</title>


<!-- Custom stlylesheet -->
<style>
* { -webkit-box-sizing: border-box; box-sizing: border-box; }
body { padding: 0; margin: 0; }
#notfound { position: relative; height: 100vh; }
#notfound .notfound { position: absolute; left: 50%; top: 50%; -webkit-transform: translate(-50%, -50%); -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%); }
.notfound { max-width: 410px; width: 100%; text-align: center; }
.notfound .notfound-404 { height: 280px; position: relative; z-index: -1; }
.notfound .notfound-404 h1 { font-family: 'Verdana', sans-serif; font-size: 230px; margin: 0px; font-weight: 900; position: absolute; left: 50%; -webkit-transform: translateX(-50%); -ms-transform: translateX(-50%); transform: translateX(-50%); background: linear-gradient(130deg, #5188f7, #013cb2); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-size: cover; background-position: center; }
.notfound h2 { font-family: 'Verdana', sans-serif; color: #000; font-size: 24px; font-weight: 700; text-transform: uppercase; margin-top: 20px; }
.notfound p { font-family: 'Verdana', sans-serif; color: #000; font-size: 14px; font-weight: 400; margin-bottom: 20px; margin-top: 0px; }
@media only screen and (max-width:767px) {
  .notfound .notfound-404 { height: 142px; }
  .notfound .notfound-404 h1 { font-size: 112px; }
}
</style>
</head>

  <body>
    <div id="notfound">
      <div class="notfound">
        <div class="notfound-404">
          <h1>404</h1>
        </div>
        <h2>Page Not Found.</h2>
        <p>Sorry! The page you are looking for was not found on this server.</p>        
      </div>
    </div>
  </body>
  
</html>
