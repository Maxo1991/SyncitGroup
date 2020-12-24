@extends('layouts.app')
@section('title', '| Welcome')
@section('content')
    <div class="container">
        <div id="create_contact">
            <div>
                <div class="row font-weight-bold">
                    <div class="col-md-3">First Name</div>
                    <div class="col-md-3">Last Name</div>
                    <div class="col-md-6">Phone number</div>
                </div>
                <div class="form_contact_0" data-id="0">
                    <div class="row">
                        <div class="col-md-3">
                            <input class="first_name" type="text">
                        </div>
                        <div class="col-md-3">
                            <input class="last_name" type="text">
                        </div>
                        <div class="col-md-2 typePhone">
                            <select id="phone_0_0" class="phone_type">
                                <option value="mobile">Mobile</option>
                                <option value="home">Home</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input id="number_0_0" type="text">
                            <p class="delete_number" onClick="return delete_number(this)" style="margin-bottom: 0; margin-top: 0; color: red;">Delete number</p>
                        </div>
                        <div class="col-md-1">
                            <p class="btn btn-danger" onClick="return delete_contact(this)">Delete</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <p class="add_number" onClick="return add_number(this)">Add number</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p id="add_contact">Add another contact</p>
                    </div>
                </div>
                <div id="errorMessage" class="row">
                    <div class="alert alert-danger" role="alert" style="width: 100%; text-align: center;">
                        You must fill in all fields!
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 offset-md-9">
                        <input type="submit" class="btn btn-info text-white float-right mt-3 font-weight-bold" onclick="return saveContact(this)" value="Save contact">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
        <script>
            (function($){
                $(document).ready(function(){
                    var j = 1;
                    $("#add_contact").click(function() {
                        var last_id = $(this).parent().parent().siblings("[class^='form_contact']").last().attr("data-id");
                        last_id = parseInt(last_id);
                        last_id += 1;
                        $(this).parent().parent().siblings("[class^='form_contact']").last().after(
                            '<div class="form_contact_' + j + '" data-id="' + j + '">' +
                            '<div class="row mt-2 number_phone">' +
                            '<div class="col-md-3">' +
                            '<input class="first_name" type="text">' +
                            '</div>' +
                            '<div class="col-md-3">' +
                            '<input class="last_name" type="text">' +
                            '</div>' +
                            '<div class="col-md-2 typePhone">' +
                            '<select id="phone_' + last_id + "_" + j + '">' +
                            '<option value="mobile">Mobile</option>' +
                            '<option value="home">Home</option>' +
                            '</select>' +
                            '</div>' +
                            '<div class="col-md-3">' +
                            '<input id="number_' + last_id + '_' + j + '" type="text">' +
                            '<p class="delete_number" onClick="return delete_number(this)" style="margin-bottom: 0; margin-top: 0; color: red;">Delete number</p>' +
                            '</div>' +
                            '<div class="col-md-1">' +
                            '<p class="btn btn-danger" class="delete_contact" onClick="return delete_contact(this)">Delete</p>' +
                            '</div>' +
                            '</div>' +
                            '<div class="row">' +
                            '<div class="col-md-6"></div>' +
                            '<div class="col-md-6">' +
                            '<p class="add_number" onClick="return add_number(this)">Add number</p>' +
                            '</div>' +
                            '</div>' +
                            '</div>'
                        );
                        j += 1;
                    });
                });
            })(jQuery);
            var i = 1;
            function add_number(current){
                var id = $(current).parent().parent().parent().attr("data-id");
                $(current).parent().parent().before('<div class="row mt-2 number_phone">' +
                    '<div class="col-md-6 col-offset-6"></div>' +
                    '<div class="col-md-2 typePhone">' +
                    '<select id="phone_' + id + '_' + i + '">' +
                    '<option value="mobile">Mobile</option>' +
                    '<option value="home">Home</option>' +
                    '</select>' +
                    '</div>' +
                    '<div class="col-md-3">' +
                    '<input id="number_' + id + '_' + i + '" type="text">' +
                    '<p class="delete_number" onClick="return delete_number(this)" style="margin-bottom: 0; margin-top: 0; color: red;">Delete number</p>' +
                    '</div>' +
                    '</div>'
                );
                i += 1;
            }
            function delete_number(current){
                var formClass = $(current).parent().parent().parent().attr('class');
                var length = $("."+formClass).children('.row').children('.typePhone').length;
                if(length > 1){
                    $(current).parent().siblings('.typePhone').children().remove();
                    $(current).siblings('input').remove();
                    $(current).remove();
                    $(current).parent().parent('.number_phone').remove();
                }
            }
            function delete_contact(current){
                var formClassCount = $(current).parent().parent().parent().siblings("div[class^='form_contact_']").length;
                if(formClassCount === 0){

                }else{
                    $(current).parent().parent().parent().remove();
                }
            }
            function saveContact(current){
                var numberError = $("input").filter(function () {return $.trim($(this).val()).length == 0}).length;
                console.log(numberError);
                if(numberError == 0){
                    $(current).parent().parent().siblings("div[class^='form_contact_']").each(function() {
                        var classForm = $(this).attr('class');
                        var firstName = $("."+classForm).find('.first_name').val();
                        var lastName = $("."+classForm).find('.last_name').val();
                        var typePhoneArray = [];
                        var typeNumberArray = [];
                        $("."+classForm).find(":selected").each(function(){
                            typePhoneArray.push($(this).val());
                        })
                        $("."+classForm).find("input[id^='number_']").each(function(){
                            typeNumberArray.push($(this).val());
                        })
                        // console.log(classForm);
                        // console.log(firstName);
                        // console.log(lastName);
                        // console.log(typePhoneArray);
                        // console.log(typeNumberArray);

                        // var url = window.location.origin + "/ajax";
                        // window.location.replace(url);
                    });
                }else{
                    $("#errorMessage").css('display', 'block');
                }
            }
        </script>
@endsection
