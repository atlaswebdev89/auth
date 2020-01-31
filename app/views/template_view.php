<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title>Byfly statistica</title>
        <link href="/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <link href="/css/style.css" rel="stylesheet"  type="text/css" />
        <script src="/js/jquery-3.2.1.js"></script>
        <script src="/js/jquery.tablesort.js"></script>
        <script src="/js/active.js"></script>
        <script src="/js/button-back.js"></script>
<!--        <script src="/js/modalajax.js"></script>-->
        <script src="/js/sort.js"></script>
    </head>
    <body>
	
	<div id="modal_form"><!-- Сaмo oкнo -->
      		<span id="modal_close">X</span> <!-- Кнoпкa зaкрыть --> 
	<div id="data"></div> 
      				<!-- Тут любoе сoдержимoе -->
		</div>
		<div id="overlay">
		<img id="loadImg_modal" src="/img/5.gif" />
					
</div><!-- Пoдлoжкa -->

    <div id="page-wrap">
    <header>
        <a href="/" title="На главную страницу" id="logo">Статистика параметров доступа в интернет</a>
        <span class="right">
        		<form name="search" method="GET" action="#">
                        <input type="search" name="number" placeholder="Поиск">
                        <button type="submit"><span>Search</span></button>
                    	</form>
        </span>
    </header>

        <div class="clear"></div>  
        <div id="logoimg"></div>
        <div class="clear"></div>  
       
        <nav id ="menu">
        	<ul >
                <li><a href="/statistica/ping">Ping</a><hr /></li>
                <li><a href="/statistica/session">Session</a><hr /></li>
                <li><a href="/statistica/los">Packet los</a><hr /></li>
                <li><a href="/statistica/speed">Speed</a><hr /></li>
                <li><a href="/query">Query Information</a><hr /></li>
                <li><a href="/quality">Quality indicators</a><hr /></li>
                <li><a href="/report">SessionReport</a><hr /></li>
                <li><a href="/grafspeed">GrafSpeed</a><hr /></li>
                <li><a href="/graflink">Graflink</a><hr /></li>
            </ul>
        </nav>
        
        <div class="clear"></div>  
       
        <div id="content" > 
		<?php include '../app/views/'.$content_view; ?>
        </div>
          <a href="#" class="scrollup">Наверх</a>

	<div class="clear"></div>
    </div>
        <div class="clear"></div>
    <footer>
        <span>dallas &copy  2017</span>
    </footer>
    
    </body>



</html>
