$(function(){
	$('#form-reginfo-1').submit(function(){
		var checkres = true;
		
		var uname = $('#uname').val();
		uname = $.trim(uname);
		var unametab = $('#uname').parents('.tr-step1').find('.msgbox');
		if(uname.length == 0){
			$(unametab).html('请填写姓名！');
			checkres = false;
		}else{
			$(unametab).html('');
		}
		
		var province = $('#province').val();
		province = $.trim(province);
		var city = $('#city').val();
		city = $.trim(city);
		var district = $('#district').val();
		district = $.trim(district);
		var adress = $('#adress').val();
		adress = $.trim(adress);
		var provincetab = $('#province').parents('.tr-step1').find('.msgbox');
		if(province.length == 0 || city.length == 0 || district.length == 0 || adress.length == 0){
			$(provincetab).html('请选择并填写住宅信息！');
			checkres = false;
		}else{
			$(provincetab).html('');
		}
		
		var cardid = $('#cardid').val();
		cardid = $.trim(cardid);
		var cardidtab = $('#cardid').parents('.tr-step1').find('.msgbox');
		var id_card = /^(^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$)|(^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])((\d{4})|\d{3}[Xx])$)$/;
		if(cardid.length == 0){
			$(cardidtab).html('请填写身份证号！');
			checkres = false;
		}else if(!id_card.test(cardid)){
			$(cardidtab).html('请填写正确的身份证号！');
			checkres = false;
		}else{
			$(cardidtab).html('');
		}
		
		var cardfile1 = $('#cardfile1').val();
		cardfile1 = $.trim(cardfile1);
		var cardfile2 = $('#cardfile2').val();
		cardfile2 = $.trim(cardfile2);
		var cardfile3 = $('#cardfile3').val();
		cardfile3 = $.trim(cardfile3);
		var cftab = $('#cardfile1').parents('.tr-step1').find('.msgbox');
		if(cardfile1.length == 0 || cardfile2.length == 0 || cardfile3.length == 0){
			$(cftab).html('请上传上传负责人的身份证信息！');
			checkres = false;
		}else{
			$(cftab).html('');
		}
		
		var carduser = $('#carduser').val();
		carduser = $.trim(carduser);
		var cutab = $('#carduser').parents('.tr-step1').find('.msgbox');
		if(carduser.length == 0){
			$(cutab).html('请填写开户人！');
			checkres = false;
		}else{
			$(cutab).html('');
		}
		
		var cardbank = $('#cardbank').val();
		cardbank = $.trim(cardbank);
		var cbtab = $('#cardbank').parents('.tr-step1').find('.msgbox');
		if(cardbank.length == 0){
			$(cbtab).html('请填写开户行！');
			checkres = false;
		}else{
			$(cbtab).html('');
		}
		
		var cardaccount = $('#cardaccount').val();
		cardaccount = $.trim(cardaccount);
		var catab = $('#cardaccount').parents('.tr-step1').find('.msgbox');
		if(cardaccount.length == 0){
			$(catab).html('请填写银行账号！');
			checkres = false;
		}else{
			$(catab).html('');
		}
		
		return checkres;
	});
	
	$('#form-reginfo-2').submit(function(){
		var checkres = true;
		
		var province = $('#province').val();
		province = $.trim(province);
		var city = $('#city').val();
		city = $.trim(city);
		var district = $('#district').val();
		district = $.trim(district);
		var adress = $('#adress').val();
		adress = $.trim(adress);
		var provincetab = $('#province').parents('.tr-step1').find('.msgbox');
		if(province.length == 0 || city.length == 0 || district.length == 0 || adress.length == 0){
			$(provincetab).html('请选择并填写店铺地址！');
			checkres = false;
		}else{
			$(provincetab).html('');
		}
		
		var bname = $('#bname').val();
		bname = $.trim(bname);
		var bnametab = $('#bname').parents('.tr-step1').find('.msgbox');
		if(bname.length == 0){
			$(bnametab).html('请填写店铺名称！');
			checkres = false;
		}else{
			$(bnametab).html('');
		}
		
		var bcall = $('#bcall').val();
		bcall = $.trim(bcall);
		var bcalltab = $('#bcall').parents('.tr-step1').find('.msgbox');
		if(bcall.length == 0){
			$(bcalltab).html('请填写店铺电话！');
			checkres = false;
		}else{
			$(bcalltab).html('');
		}
		
		var industry = $('#industry').val();
		industry = $.trim(industry);
		var idstab = $('#industry').parents('.tr-step1').find('.msgbox');
		if(industry.length == 0){
			$(idstab).html('请选择所属行业！');
			checkres = false;
		}else{
			$(idstab).html('');
		}
		
		var license = $('#license').val();
		license = $.trim(license);
		var licensef = $('#licensefile').val();
		licensef = $.trim(licensef);
	    if(license.length == 0 && licensef.length == 0){
	    	$('#license-error').html('请上传营业执照照片或填写说明');
	    	checkres =  false;
	    }else{
	    	$('#license-error').html('');
	    }
	    
	    var pacts = $('#pacts').val();
		var pacte = $('#pacte').val();
		var proves = $('#proves').val();
		var provee = $('#provee').val();
	    if(pacts.length == 0 && pacte.length == 0 && proves.length == 0 && provee.length == 0){
	    	$('#pact-error').html('请上传租赁合同或房产证明照片');
	    	$('#prove-error').html('请上传租赁合同或房产证明照片');
	    	checkres =  false;
	    }else if((pacts.length > 0 && pacte.length == 0) || (pacts.length == 0 && pacte.length > 0)){
	    	$('#pact-error').html('请上传租赁合同首页和尾页');
	    	checkres =  false;
	    }else if((proves.length > 0 && provee.length == 0) || (proves.length == 0 && provee.length > 0)){
	    	$('#prove-error').html('请上传房产证明首页和尾页');
	    	checkres =  false;
	    }else{
	    	$('#pact-error').html('');
	    	$('#prove-error').html('');
	    }
	    
	    var photofile = $('#photofile').val();
		photofile = $.trim(photofile);
		var pftab = $('#photofile').parents('.tr-step1').find('.msgbox');
		if(photofile.length == 0){
			$(pftab).html('请上传法人照片！');
			checkres = false;
		}else{
			$(pftab).html('');
		}
		
		var placefile = $('#placefile').val();
		placefile = $.trim(placefile);
		var plftab = $('#placefile').parents('.tr-step1').find('.msgbox');
		if(placefile.length == 0){
			$(plftab).html('请上传经营场地照片！');
			checkres = false;
		}else{
			$(plftab).html('');
		}
		
		var billfile = $('#billfile').val();
		billfile = $.trim(billfile);
		var blftab = $('#billfile').parents('.tr-step1').find('.msgbox');
		if(billfile.length == 0){
			$(blftab).html('请上传水电票据照片！');
			checkres = false;
		}else{
			$(blftab).html('');
		}
		
		return checkres;
	});
	
	$('#form-reginfo-3').submit(function(){
		var checkres = true;
		var legal_person_phone = /^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/;
		
		var uname1 = $('#uname1').val();
		uname1 = $.trim(uname1);
		var phone1 = $('#phone1').val();
		phone1 = $.trim(phone1);
		var uname1tab = $('#phone1').parents('.tr-step3').find('.msgbox');
		if(uname1.length == 0 || phone1.length == 0){
			$(uname1tab).html('请填写紧急联系人姓名和手机号码！');
			checkres = false;
		}else if(!legal_person_phone.test(phone1)){
			$(uname1tab).html('请填写正确的手机号码！');
			checkres = false;
		}else{
			$(uname1tab).html('');
		}
		
		var uname2 = $('#uname2').val();
		uname2 = $.trim(uname2);
		var phone2 = $('#phone2').val();
		phone2 = $.trim(phone2);
		var uname2tab = $('#phone2').parents('.tr-step3').find('.msgbox');
		if(uname2.length == 0 || phone2.length == 0){
			$(uname2tab).html('请填写紧急联系人姓名和手机号码！');
			checkres = false;
		}else if(!legal_person_phone.test(phone2)){
			$(uname2tab).html('请填写正确的手机号码！');
			checkres = false;
		}else{
			$(uname2tab).html('');
		}
		
		var uname3 = $('#uname3').val();
		uname3 = $.trim(uname3);
		var phone3 = $('#phone3').val();
		phone3 = $.trim(phone3);
		var uname3tab = $('#phone3').parents('.tr-step3').find('.msgbox');
		if(uname3.length == 0 || phone3.length == 0){
			$(uname3tab).html('请填写紧急联系人姓名和手机号码！');
			checkres = false;
		}else if(!legal_person_phone.test(phone3)){
			$(uname3tab).html('请填写正确的手机号码！');
			checkres = false;
		}else{
			$(uname3tab).html('');
		}
		
		return checkres;
	});
});
