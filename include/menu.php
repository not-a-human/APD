<nav id="navbar" class="nav-menu navbar mt-3">
	<ul>
	    <li><a href="#" onclick="setLanguage()" id="navLang" class="nav-link border-dark border-bottom mb-3"><i class="bx bi-translate"></i> <span>EN/MS</span></a></li>
		<?php
		if(isset($_SESSION['admin'])){
			if(isset($pageIndex)){
				$xxIndex = "admin/";
				$xxLogout = "logout";
			}else{
				$xxIndex = "";
				$xxLogout = '../logout';
			}
			echo '
				<li><a href="'.$xxIndex.'index" id="navHome" class="nav-link"><i class="bx bx-home"></i> <span>Home</span></a></li>
				<li><a href="'.$xxIndex.'admin_minggu?m=ini" id="navThisWeek" class="nav-link"><i class="bx bx-calendar"></i> <span>Minggu ini</span></span></a></li>
				<li><a href="'.$xxIndex.'admin_minggu?m=depan" id="navNextWeek" class="nav-link"><i class="bx bx-calendar-event"></i> <span>Minggu Depan</span></span></a></li>
				<li><a href="'.$xxIndex.'admin_user_list" id="navPengguna" class="nav-link"><i class="bi bi-person-lines-fill"></i> <span>Pengguna</span></span></a></li>
				<li><a href="'.$xxIndex.'admin_record" id="navRekodTempahan" class="nav-link"><i class="bx bx-list-ul"></i> <span>Rekod Tempahan</span></span></a></li>
				<li><a href="'.$xxIndex.'admin_add_user" id="navAddUser" class="nav-link"><i class="bx bx-plus"></i> <span>Tambah User</span></a></li>
				<li><a href="https://sites.google.com/view/bilikapd/admin" id="navDownload" class="nav-link"><i class="bx bx-download"></i> <span>Muat Turun</span></a></li>
				<li><a href="'.$xxLogout.'" id="navLogOut" class="nav-link"><i class="bx bx-door-open"></i> <span>Log Out</span></a></li>
			';
		}elseif(isset($_SESSION['pensyarah'])){
			echo '
				<li><a href="index" id="navHome" class="nav-link"><i class="bx bx-home"></i> <span>Home</span></a></li>
				<li><a href="user_minggu?m=ini" id="navThisWeek" class="nav-link"><i class="bx bx-calendar"></i> <span>Minggu ini</span></span></a></li>
				<li><a href="user_minggu?m=depan" id="navNextWeek" class="nav-link"><i class="bx bx-calendar-event"></i> <span>Minggu Depan</span></span></a></li>
				<li><a href="verify" id="navVerify" class="nav-link"><i class="bx bx-calendar-check"></i> <span>Verify (Check In)</span></span></a></li>
				<li><a href="verify_out" id="navVerifyOut" class="nav-link"><i class="bx bx-calendar-x"></i> <span>Verify (Check Out)</span></span></a></li>
				<li><a target="_blank" href="https://sites.google.com/view/bilikapd/user" id="navDownload" class="nav-link"><i class="bx bx-download"></i> <span>Muat Turun</span></a></li>
				<li><a href="logout" id="navLogOut" class="nav-link"><i class="bx bx-door-open"></i> <span>Log Out</span></a></li>
			';
		}else{
			echo '
				<li><a href="index" id="navHome" class="nav-link"><i class="bx bx-home"></i> <span>Home</span></a></li>
				<li><a href="user_minggu?m=ini" id="navThisWeek-non" class="nav-link"><i class="bx bx-calendar"></i> <span>Minggu ini</span></span></a></li>
				<li><a href="user_minggu?m=depan" id="navNextWeek-non" class="nav-link"><i class="bx bx-calendar-event"></i> <span>Minggu Depan</span></span></a></li>
				<li><a target="_blank" href="https://sites.google.com/view/bilikapd/user" id="navDownload" class="nav-link"><i class="bx bx-download"></i> <span>Muat Turun</span></a></li>
				<li><a href="user_login" id="navLogIn" class="nav-link"><i class="bx bx-door-open"></i> <span>Log In</span></a></li>
			';
		}
		?>
	</ul>
</nav><!-- .nav-menu -->
<?php
echo '
	<script>
		$(".nav-menu #'.$page.'").addClass("active");
		
		function setLanguage(){
		    let lang;
		    if(localStorage.getItem("language") == null){
		        lang = "en";
		    }else{
		        lang = localStorage.getItem("language");
		        if(lang == "en"){
		            lang = "ms";
		        }else{
		            lang = "en";
		        }
		    }
		    localStorage.setItem("language",lang);
		    location.reload();
		}
	</script>
';
?>