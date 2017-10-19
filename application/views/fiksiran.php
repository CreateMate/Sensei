<body>
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
			
			<script src="<?php echo $base_url;?>js/oblast_posta.js"></script>
                       <script src="<?php echo $base_url;?>js/autor.js"></script>
	<nav class="stay-top">
		<div class="stay-top-icon">
                    <a href="<?php echo $base_url; ?>Sadrzaj"><img src="<?php echo $base_url; ?>images/sensei_icon.png" width="100%" height="100%"></a>
		</div>
		<form>
                    <input type="text" class="form-control" placeholder="Search   Sensei " id="UserName" class="sensei" onkeyup="ajaxOnKeyUp();">
		</form>
		
		<div class="stay-top-right">
			<img src="<?php echo $base_url; ?>images/acc3.png" alt="image" class="acc"/>
			
                        <h2 class="link lightUp"><?php echo $username; ?></h2>
			
		</div>
		
	</nav><br/>