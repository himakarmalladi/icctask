function number_validate(val,minLen,maxLen,fName,errId, type){ 
    type='enter'; var errs = ''; val = val.toString(); 
    if(val==''){errs ='Please enter '+fName;} 
    else if(isNaN(val)){errs = 'Please enter numbers only';} 
    else if(val.length<minLen){errs = 'Please enter minimum '+minLen+' digits';} 
    else if(maxLen>0 && val.length>maxLen){errs = 'Please enter '+maxLen+' digits';}
    else{errs='';}
    return errs;
}
var string_space_filter = /^[a-zA-Z\s]+$/;
function string_space_validate(val,minLen,maxLen,fName, type){ 
    type='enter'; var errs = ''; val = val.toString(); 
    if(val==''){errs ='Please enter '+fName;} 
    else if(val.length<minLen){errs = 'Please '+type+' minimum '+minLen+' characters';} 
    else if(maxLen>0 && val.length>maxLen){errs = 'Please '+type+' '+maxLen+' characters';} 
    else if(!string_space_filter.test(val)){errs = 'Please '+type+' alphabets only';} 
    else{errs='';} 
    return errs;
}
var email_filter = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
function email_validate(val,minLen,maxLen,fName,errId){ 
    var errs = ''; val = val.toString(); 
    if(val==''){errs = 'Please enter '+fName;} 
    else if(val.length<minLen){errs = 'Please enter minimum '+minLen+' characters';} 
    else if(maxLen>0 && val.length>maxLen){errs = 'Please enter '+maxLen+' characters';} 
    else if(!email_filter.test(val)){errs = 'Please enter valid email';} 
    else{errs='';} 
    return errs; 
}
function varchar_validate(val,minLen,maxLen,fName, type){ 
    type='enter'; var errs = ''; val = val.toString(); 
    if(val==''){errs = 'Please '+type+' '+fName;} 
    else if(val.length<minLen){errs = 'Please '+type+' minimum '+minLen+' characters';} 
    else if(maxLen>0 && val.length>maxLen){errs = 'Please '+type+' '+maxLen+' characters';} 
    else{errs='';} 
    return errs; 
}
var string_filter = /^[a-zA-Z]+$/;
function string_validate(val,minLen,maxLen,fName, type){
    type='enter';var errs = '';val = val.toString();
    if(val==''){errs ='Please enter '+fName;}
    else if(val.length<minLen){errs = 'Please '+type+' minimum '+minLen+' characters';}
    else if(maxLen>0 && val.length>maxLen){errs = 'Please '+type+' '+maxLen+' characters';}
    else if(!string_filter.test(val)){errs = 'Please '+type+' alphabets only';}
    else{errs='';}
    return errs;
}    
function error_list(err){ $('.error').html('').removeClass('erroreq'); var errors = $.each(err, function(key, value){ if(value!=''){ $('#'+key+'_error').html(value).addClass('erroreq');}else{delete(err[key]);} }); $('.erroreq').eq(0).siblings('input').focus();return errors;}
  
$('#new_generated_form').on('submit', function(e){
    var err = new Object();
        err.Roll_Number = number_validate($('#Roll_Number').val().trim(),'1','10','Roll Number');
        err.Student_Name = string_space_validate($('#Student_Name').val().trim(),'3','60','Student Name');
        err.Email = email_validate($('#Email').val().trim(),'5','60','Email');
        err.Mobile = number_validate($('#Mobile').val().trim(),'10','15','Mobile');
        err.Department = varchar_validate($('#Department').val().trim(),'2','60','Department');
        err.Subject = varchar_validate($('#Subject').val().trim(),'2','60','Subject');
        err.Marks_Obtain = number_validate($('#Marks_Obtain').val().trim(),'1','3','Marks Obtain');
        err.Result = string_validate($('#Result').val().trim(),'1','5','Result');
        err.Grade = varchar_validate($('#Grade').val().trim(),'1','3','Grade');
        var errors = error_list(err);
    $('#success_msg').html('');
    if(Object.keys(errors).length<=0){
        $('#success_msg').html('Form submitted successfully');
        return true;
    }
    return false;
});
$('#Roll_Number').on('input', function(){
    $('#Roll_Number_error').html('');
    var val = $('#Roll_Number').val().trim();
    roll_Number = number_validate(val,'4','10','Roll Number');
    if(roll_Number!=''){
        $('#Roll_Number_error').html(roll_Number);
    }else{
        $.ajax({
            url:'ajaxRequest.php',
            type:'POST',
            data:{rollNumber: val,action:'get_student_data'},
            success: function(resp){
                res = JSON.parse(resp);
                if(res.status==200){
                    $('#Student_Name').val(res.data.name);
                    $('#Email').val(res.data.email);
                    $('#Mobile').val(res.data.mobile);
                    $('#Department').val(res.data.dept);
                }else{
                    $('#Roll_Number_error').html(res.message);
                }
            }
        });
    }  
});
$('#Marks_Obtain').on('input', function(){
    $('#Marks_Obtain_error').html('');
    var val = $('#Marks_Obtain').val().trim();
    marks = number_validate(val,'1','3','Marks Obtain');
    marks = marks=='' && val>100?'Marks should be less than or equal to 100':marks;
    if(marks!=''){
        $('#Marks_Obtain_error').html(marks);
    }else{
        var result = val>50?'Pass':'Fail';
        $('#Result').val(result);
        var grad = 'F';
        if(val>=90){grad='S';}
        if(val>=80 && val<90){grad='A+';}
        if(val>=70 && val<80){grad='A';}
        if(val>=60 && val<70){grad='B';}
        if(val>=50 && val<60){grad='C';}
        $('#Grade').val(grad);
    }
});
