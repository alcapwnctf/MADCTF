window.onload=$(function(){
	checkLogin();
	checkDQ();
	getQuestion();

});


function correctAns() {
document.getElementById('qs').innerHTML = '<div class="f-modal-alert"><div class="f-modal-icon f-modal-success animate"><span class="f-modal-line f-modal-tip animateSuccessTip"></span><span class="f-modal-line f-modal-long animateSuccessLong"></span><div class="f-modal-placeholder"></div><div class="f-modal-fix"></div></div></div>';
}


function wrongAns() {
	document.getElementById('qs').innerHTML = '<div class="f-modal-alert"><div class="f-modal-icon f-modal-error animate"><span class="f-modal-x-mark"><span class="f-modal-line f-modal-left animateXLeft"></span><span class="f-modal-line f-modal-right animateXRight"></span></span><div class="f-modal-placeholder"></div><div class="f-modal-fix"></div></div></div>';
}

function fadeAnim() {
	document.getElementById('qs').innerHTML = '<div id="question"></div><div id="image"></div><div id="html"></div>';
        getQuestion();
}


function checkLogin() {
	// console.log(9887);
	$.getJSON('getLogin.php', function(loggedin) {
 		// console.log(loggedin);
 		if (loggedin == 0) {
 			// window.open('../index.php','_self');
 			window.location="../index.php?msg=2";
 			// console.log('not logged in');
 			// return 0;
 		}
 		else {
 			console.log('loggedin');
 			// return 1;
 		}
 	});
}


function checkDQ() {
	$.getJSON('getDQ.php', function(dq) {
		if (dq == 1) {
 			// window.loca('disqualified.php','_self');
 			window.location="disqualified.php";
 			// console.log('dqed');
 		}
 	});
}


function getQuestion(){
	$.getJSON('getQuestion.php', function(response) {
		console.log(response);
		document.getElementsByClassName('level')[0].innerHTML = "Level " + response.level;
		if (response.question !== '') {
			document.getElementById('question').innerHTML = response.question;
		}
		else {
			document.getElementById('question').innerHTML = '';
		}

		if (response.image !== '') {
			document.getElementById('image').innerHTML = "<img src='../home/imgques/"+response.image+"'>";
		}
		else {
			document.getElementById('image').innerHTML = '';
		}

		if (response.html !== '') {
			document.getElementById('html').innerHTML = response.html;
		}
		else {
			document.getElementById('html').innerHTML = '';
		}

		if (response.hint !== '') {
			document.getElementById('hint').innerHTML = "<!-- "+response.hint+" -->";
		}
		else {
			document.getElementById('hint').innerHTML = '';
		}

	});
}



// getQuestion();

function subAns() {
	checkLogin();
	checkDQ();
	var	ans = document.getElementById('ans');
	var dataStr="answer="+ans.value;

	$.ajax({
		type:'POST',
		url:'ansSub.php',
		data: dataStr,
		success:function(r) {
			console.log(r);
			var obj = JSON.parse(r);
			ans.value="";
			if (obj.correct == 0) {
 			// console.log('Wrong Answer!');
 			// wrongAns();
 			wrongAns();
 			setTimeout(function(){
 				fadeAnim();
 			},1200)
 		}
 		else if (obj.correct == 1) {
 			// console.log('Right Answer!');
 			correctAns();
 			setTimeout(function(){
 				fadeAnim();
 			},1200)
 			setTimeout(function(){
 				getQuestion();
 			},400);
 		}
 	}
 });
}


