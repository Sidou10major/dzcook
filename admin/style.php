<?php
    header('Content-type: text/css; charset: UTF-8');
    require_once __DIR__.'/../admin/Models/params.php';
    $paramsModel=new paramsModel();
    $params=$paramsModel->getParams();
    foreach($params as $param){
        $GLOBALS[$param['cle']]=$param['valeur'];
    }
?>

:root {
    --primary1: <?php echo $GLOBALS['primary1']; ?>;
    --primary2: <?php echo $GLOBALS['primary2']; ?>;
    --secondary1: <?php echo $GLOBALS['secondary1']; ?>;
    --secondary2: <?php echo $GLOBALS['secondary2']; ?>;
    --bgRGB: <?php echo $GLOBALS['bgRGB']; ?>;
    --black: <?php echo $GLOBALS['black']; ?>;
    --body:  <?php echo $GLOBALS['body']; ?>;
}


* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
    -webkit-user-drag: none;
}
body{
    background-color: rgb(var(--body));
}

a, a:visited {
    text-decoration: none;
    color: rgb(var(--black));
}
nav {
    padding: 16px 32px;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: rgba(var(--black),0.15) 1px solid;
}


.call-action {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
}
.call-action img{
    size: 8px;
}

.menu {
    display: flex;
    justify-content: space-between;
    align-items: center;
    list-style: none;
    gap: 24px;
    margin: 0;
    padding: 0;
}

.menu li{
    font-family: 'Raleway';
    font-style: normal;
    font-weight: 700;
    cursor: pointer;
}


menu a:active, .menu a:hover, .menu a:focus {
    color: var(--primary1);
}
.sub-menu {
    display: none;
    list-style: none;
}
.menu li:hover .sub-menu {
    display: flex;
    flex-direction: column;
    gap: 8px;
    position: absolute;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    padding: 8px 16px;
    z-index: 1;
}
.prm-btn {
    color: var(--secondary2);
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    background: linear-gradient(90deg, #DD5353 0%, #B73E3E 100%);
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border: none;
}

.prm-btn:hover {
    background-color: var(--primary1);
    color: #fff;
}

.secondary-btn{
    background-color: white;
    border: 0;
    padding: 4px 8px;
    font-family: 'Roboto';
    font-weight: 500;
    font-size: 16px;
    color: rgba(var(--black), 0.75);
    border: 1px solid rgba(var(--black), 0.75);
    border-radius: 8px;
}
.secondary-btn:hover{
    background-color: rgba(var(--black), 0.75);
    color: white;
}
.nav-logo{
    width: 48px;
    height: 48px;
}
.auth-logo{
    width: 45%;
}
.dashboard-container{
    display: grid;
    justify-content: space-between;
    grid-template-columns: repeat(auto-fit, 250px);
    align-items: flex-start;
    padding: 32px 32px;
    gap: 32px;
}
.card-container{
    width: 250px;
    height: 250px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    padding: 16px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.card-img{
    width: 100%;
    height: 50%;
    object-fit: cover;
    border-radius: 8px;
}
.card-title{
    font-family: 'Raleway';
    font-style: normal;
    font-weight: 700;
    font-size: 20px;
    color: rgba(var(--black), 0.75);
}
.admin-auth,.verticale-container{
    display: flex;
    justify-content: space-between;
    gap: 16px;
    padding: 16px 32px;
    
}
.login{
    display: block;
    padding: 16px 32px;
    background-color: rgba(var(--bgRGB),0.5);
    border-radius: 8px;
}
.login>h3{
    font-family: 'Raleway';
    font-weight: bold;
    font-size: 32px;
    color: rgb(var(--black));
    text-align: center;
}
.horizontale-container{
    display: flex;
    justify-content: space-between;
    gap: 16px;
    padding: 16px 32px;
}
.form{
    width: 45%;
}
.form .horizontale-container,.form .verticale-container{
    padding: 8px 16px;
}
.form label,.form input{
    display:block;
    padding: 8px 16px;
}
.form input{
    border: 1px rgba(var(--black),0.15) solid;
    border-radius: 8px;
}
.form label{
    font-family: 'Raleway';
    font-weight: bold;
    font-size: 16px;
    color: rgb(var(--black));
}

.table-container{
    padding: 16px 32px;
    background-color: rgba(var(--bgRGB),0.5);
    border-radius: 8px;
    width: 100%;
    overflow-x: scroll;
}

.popout{
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(var(--bgRGB),0.5);
    z-index: 100;
    overflow: auto;
    padding: 16px 32px;
}
.popout .popout-container{
    background-color: white;
    margin: auto;
    padding: 16px 32px;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 16px;
    font-family: 'Roboto';
    width: 40%;
}
.popout .popout-container .prm-btn{
    margin: auto;
}
.popout .popout-container .secondary-btn{
    margin: auto;
}
.popout .h6{
    padding: 0;
}
.active{
    display: block;
}