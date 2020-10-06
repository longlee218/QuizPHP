<?php include_once './MVC/Views/inc/master.php'?>
<style>
    .container-fluid{
        font-family: Arial, cursive;
        font-size: 15px;
    }
    .info-user{
        width: 350px;
        /*height: 550px;*/
        max-height: 700px;
        /*border-right-style: inset;*/
        /*border-top-style: outset;*/
        /*border-bottom-style: inset;*/
        /*border-radius: 20px;*/
        padding: 15px;
        margin-top: 20px;
        margin-bottom: 30px;
    }
    .username{
        padding-top: 10px;
    }
    #username-small{
        margin-top: 15px;
    }
    .title{
        font-size: 13px;
        font-weight: bold;
    }
    .time_join{
        font-size: 13px;
        float: right;
    }
    .update-info{
        display: none;
        font-size: 13px;
    }
    .content{
        min-height: 100%;
    }
</style>

<div class="container-fluid content">
    <div class="row">
        <div class="info-user">
            <h2 class="username">
                <span id="username-big"></span>
                <p id="username-small" style="font-size: 15px"></p>
            </h2>
            <div class="" id="position"></div>
            <button class="btn btn-block mt-4 mb-4 border-dark" id="btn-edit" onclick="visibleForm(this)">
                <small class="font-weight-bold">Chỉnh sửa</small></button>
            <div id="more-info"></div>
            <hr>
            <div id="number_room"></div>
            <div id="number_quiz"></div>
            <br>
            <form class="update-info" id="form-update" >
                <div class="form-row">
                    <div class="col form-group">
                        <label>Họ </label>
                        <input type="text" class="form-control" placeholder="" id="first_name" required >
                    </div> <!-- form-group end.// -->
                    <div class="col form-group">
                        <label>Tên</label>
                        <input type="text" class="form-control" placeholder=" " id="last_name" required>
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row end.// -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="example@examp.com" id="email" required>
                    <small class="text-danger" id="messages_email"></small>
                </div> <!-- form-group end.// -->
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="1">
                            <span class="form-check-label"> Nam </span>
                        </label>
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="0">
                            <span class="form-check-label"> Nữ</span>
                        </label>
                        <label class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="2">
                            <span class="form-check-label"> Khác</span>
                        </label>
                    </div>
                </div> <!-- form-group end.// -->
                <div class="form-row">
                    <div class="form-group">
                        <a class="float-right text-primary" id="reset_password" href="/../QuizSys/change_password/">Thay đổi mật khẩu?</a>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Thành phố</label>
                        <input type="text" class="form-control" id="city" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Quốc gia</label>
                        <select id="country" class="form-control" required>
                            <option> Choose</option>
                            <option value="AX">Åland Islands</option>
                            <option value="AL">Albania</option>
                            <option value="DZ">Algeria</option>
                            <option value="AS">American Samoa</option>
                            <option value="AD">Andorra</option>
                            <option value="AO">Angola</option>
                            <option value="AI">Anguilla</option>
                            <option value="AQ">Antarctica</option>
                            <option value="AG">Antigua and Barbuda</option>
                            <option value="AR">Argentina</option>
                            <option value="AM">Armenia</option>
                            <option value="AW">Aruba</option>
                            <option value="AU">Australia</option>
                            <option value="AT">Austria</option>
                            <option value="AZ">Azerbaijan</option>
                            <option value="BS">Bahamas</option>
                            <option value="BH">Bahrain</option>
                            <option value="BD">Bangladesh</option>
                            <option value="BB">Barbados</option>
                            <option value="BY">Belarus</option>
                            <option value="BE">Belgium</option>
                            <option value="BZ">Belize</option>
                            <option value="BJ">Benin</option>
                            <option value="BM">Bermuda</option>
                            <option value="BT">Bhutan</option>
                            <option value="BO">Bolivia, Plurinational State of</option>
                            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                            <option value="BA">Bosnia and Herzegovina</option>
                            <option value="BW">Botswana</option>
                            <option value="BV">Bouvet Island</option>
                            <option value="BR">Brazil</option>
                            <option value="IO">British Indian Ocean Territory</option>
                            <option value="BN">Brunei Darussalam</option>
                            <option value="BG">Bulgaria</option>
                            <option value="BF">Burkina Faso</option>
                            <option value="BI">Burundi</option>
                            <option value="KH">Cambodia</option>
                            <option value="CM">Cameroon</option>
                            <option value="CA">Canada</option>
                            <option value="CV">Cape Verde</option>
                            <option value="KY">Cayman Islands</option>
                            <option value="CF">Central African Republic</option>
                            <option value="TD">Chad</option>
                            <option value="CL">Chile</option>
                            <option value="CN">China</option>
                            <option value="CX">Christmas Island</option>
                            <option value="CC">Cocos (Keeling) Islands</option>
                            <option value="CO">Colombia</option>
                            <option value="KM">Comoros</option>
                            <option value="CG">Congo</option>
                            <option value="CD">Congo, the Democratic Republic of the</option>
                            <option value="CK">Cook Islands</option>
                            <option value="CR">Costa Rica</option>
                            <option value="CI">Côte d'Ivoire</option>
                            <option value="HR">Croatia</option>
                            <option value="CU">Cuba</option>
                            <option value="CW">Curaçao</option>
                            <option value="CY">Cyprus</option>
                            <option value="CZ">Czech Republic</option>
                            <option value="DK">Denmark</option>
                            <option value="DJ">Djibouti</option>
                            <option value="DM">Dominica</option>
                            <option value="DO">Dominican Republic</option>
                            <option value="EC">Ecuador</option>
                            <option value="EG">Egypt</option>
                            <option value="SV">El Salvador</option>
                            <option value="GQ">Equatorial Guinea</option>
                            <option value="ER">Eritrea</option>
                            <option value="EE">Estonia</option>
                            <option value="ET">Ethiopia</option>
                            <option value="FK">Falkland Islands (Malvinas)</option>
                            <option value="FO">Faroe Islands</option>
                            <option value="FJ">Fiji</option>
                            <option value="FI">Finland</option>
                            <option value="FR">France</option>
                            <option value="GF">French Guiana</option>
                            <option value="PF">French Polynesia</option>
                            <option value="TF">French Southern Territories</option>
                            <option value="GA">Gabon</option>
                            <option value="GM">Gambia</option>
                            <option value="GE">Georgia</option>
                            <option value="DE">Germany</option>
                            <option value="GH">Ghana</option>
                            <option value="GI">Gibraltar</option>
                            <option value="GR">Greece</option>
                            <option value="GL">Greenland</option>
                            <option value="GD">Grenada</option>
                            <option value="GP">Guadeloupe</option>
                            <option value="GU">Guam</option>
                            <option value="GT">Guatemala</option>
                            <option value="GG">Guernsey</option>
                            <option value="GN">Guinea</option>
                            <option value="GW">Guinea-Bissau</option>
                            <option value="GY">Guyana</option>
                            <option value="HT">Haiti</option>
                            <option value="HM">Heard Island and McDonald Islands</option>
                            <option value="VA">Holy See (Vatican City State)</option>
                            <option value="HN">Honduras</option>
                            <option value="HK">Hong Kong</option>
                            <option value="HU">Hungary</option>
                            <option value="IS">Iceland</option>
                            <option value="IN">India</option>
                            <option value="ID">Indonesia</option>
                            <option value="IR">Iran, Islamic Republic of</option>
                            <option value="IQ">Iraq</option>
                            <option value="IE">Ireland</option>
                            <option value="IM">Isle of Man</option>
                            <option value="IL">Israel</option>
                            <option value="IT">Italy</option>
                            <option value="JM">Jamaica</option>
                            <option value="JP">Japan</option>
                            <option value="JE">Jersey</option>
                            <option value="JO">Jordan</option>
                            <option value="KZ">Kazakhstan</option>
                            <option value="KE">Kenya</option>
                            <option value="KI">Kiribati</option>
                            <option value="KP">Korea, Democratic People's Republic of</option>
                            <option value="KR">Korea, Republic of</option>
                            <option value="KW">Kuwait</option>
                            <option value="KG">Kyrgyzstan</option>
                            <option value="LA">Lao People's Democratic Republic</option>
                            <option value="LV">Latvia</option>
                            <option value="LB">Lebanon</option>
                            <option value="LS">Lesotho</option>
                            <option value="LR">Liberia</option>
                            <option value="LY">Libya</option>
                            <option value="LI">Liechtenstein</option>
                            <option value="LT">Lithuania</option>
                            <option value="LU">Luxembourg</option>
                            <option value="MO">Macao</option>
                            <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                            <option value="MG">Madagascar</option>
                            <option value="MW">Malawi</option>
                            <option value="MY">Malaysia</option>
                            <option value="MV">Maldives</option>
                            <option value="ML">Mali</option>
                            <option value="MT">Malta</option>
                            <option value="MH">Marshall Islands</option>
                            <option value="MQ">Martinique</option>
                            <option value="MR">Mauritania</option>
                            <option value="MU">Mauritius</option>
                            <option value="YT">Mayotte</option>
                            <option value="MX">Mexico</option>
                            <option value="FM">Micronesia, Federated States of</option>
                            <option value="MD">Moldova, Republic of</option>
                            <option value="MC">Monaco</option>
                            <option value="MN">Mongolia</option>
                            <option value="ME">Montenegro</option>
                            <option value="MS">Montserrat</option>
                            <option value="MA">Morocco</option>
                            <option value="MZ">Mozambique</option>
                            <option value="MM">Myanmar</option>
                            <option value="NA">Namibia</option>
                            <option value="NR">Nauru</option>
                            <option value="NP">Nepal</option>
                            <option value="NL">Netherlands</option>
                            <option value="NC">New Caledonia</option>
                            <option value="NZ">New Zealand</option>
                            <option value="NI">Nicaragua</option>
                            <option value="NE">Niger</option>
                            <option value="NG">Nigeria</option>
                            <option value="NU">Niue</option>
                            <option value="NF">Norfolk Island</option>
                            <option value="MP">Northern Mariana Islands</option>
                            <option value="NO">Norway</option>
                            <option value="OM">Oman</option>
                            <option value="PK">Pakistan</option>
                            <option value="PW">Palau</option>
                            <option value="PS">Palestinian Territory, Occupied</option>
                            <option value="PA">Panama</option>
                            <option value="PG">Papua New Guinea</option>
                            <option value="PY">Paraguay</option>
                            <option value="PE">Peru</option>
                            <option value="PH">Philippines</option>
                            <option value="PN">Pitcairn</option>
                            <option value="PL">Poland</option>
                            <option value="PT">Portugal</option>
                            <option value="PR">Puerto Rico</option>
                            <option value="QA">Qatar</option>
                            <option value="RE">Réunion</option>
                            <option value="RO">Romania</option>
                            <option value="RU">Russian Federation</option>
                            <option value="RW">Rwanda</option>
                            <option value="BL">Saint Barthélemy</option>
                            <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                            <option value="KN">Saint Kitts and Nevis</option>
                            <option value="LC">Saint Lucia</option>
                            <option value="MF">Saint Martin (French part)</option>
                            <option value="PM">Saint Pierre and Miquelon</option>
                            <option value="VC">Saint Vincent and the Grenadines</option>
                            <option value="WS">Samoa</option>
                            <option value="SM">San Marino</option>
                            <option value="ST">Sao Tome and Principe</option>
                            <option value="SA">Saudi Arabia</option>
                            <option value="SN">Senegal</option>
                            <option value="RS">Serbia</option>
                            <option value="SC">Seychelles</option>
                            <option value="SL">Sierra Leone</option>
                            <option value="SG">Singapore</option>
                            <option value="SX">Sint Maarten (Dutch part)</option>
                            <option value="SK">Slovakia</option>
                            <option value="SI">Slovenia</option>
                            <option value="SB">Solomon Islands</option>
                            <option value="SO">Somalia</option>
                            <option value="ZA">South Africa</option>
                            <option value="GS">South Georgia and the South Sandwich Islands</option>
                            <option value="SS">South Sudan</option>
                            <option value="ES">Spain</option>
                            <option value="LK">Sri Lanka</option>
                            <option value="SD">Sudan</option>
                            <option value="SR">Suriname</option>
                            <option value="SJ">Svalbard and Jan Mayen</option>
                            <option value="SZ">Swaziland</option>
                            <option value="SE">Sweden</option>
                            <option value="CH">Switzerland</option>
                            <option value="SY">Syrian Arab Republic</option>
                            <option value="TW">Taiwan, Province of China</option>
                            <option value="TJ">Tajikistan</option>
                            <option value="TZ">Tanzania, United Republic of</option>
                            <option value="TH">Thailand</option>
                            <option value="TL">Timor-Leste</option>
                            <option value="TG">Togo</option>
                            <option value="TK">Tokelau</option>
                            <option value="TO">Tonga</option>
                            <option value="TT">Trinidad and Tobago</option>
                            <option value="TN">Tunisia</option>
                            <option value="TR">Turkey</option>
                            <option value="TM">Turkmenistan</option>
                            <option value="TC">Turks and Caicos Islands</option>
                            <option value="TV">Tuvalu</option>
                            <option value="UG">Uganda</option>
                            <option value="UA">Ukraine</option>
                            <option value="AE">United Arab Emirates</option>
                            <option value="GB">United Kingdom</option>
                            <option value="US">United States</option>
                            <option value="UM">United States Minor Outlying Islands</option>
                            <option value="UY">Uruguay</option>
                            <option value="UZ">Uzbekistan</option>
                            <option value="VU">Vanuatu</option>
                            <option value="VE">Venezuela, Bolivarian Republic of</option>
                            <option value="VN">Viet Nam</option>
                            <option value="VG">Virgin Islands, British</option>
                            <option value="VI">Virgin Islands, U.S.</option>
                            <option value="WF">Wallis and Futuna</option>
                            <option value="EH">Western Sahara</option>
                            <option value="YE">Yemen</option>
                            <option value="ZM">Zambia</option>
                            <option value="ZW">Zimbabwe</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nơi làm việc/Giảng dạy</label>
                        <input type="text" class="form-control" id="organization_name">
                    </div> <!-- form-group end.// -->
                    <div class="form-group col-md-6">
                        <label>Chức vụ</label>
                        <input type="text" class="form-control" id="position_input">
                    </div> <!-- form-group end.// -->
                </div><!-- form-row.// -->
                <div class="form-group">
                    <div class="col-xs-12">
                        <br>
                        <button class="btn btn-outline-success" id="save"><small>Lưu</small></button>
                        <button class="btn" type="reset" id="cancel" onclick="backInfo()"><small>Hủy</small></button>
                    </div>
                </div>
                <hr>
            </form>
            <div id="time_join" class="time_join text-secondary"></div>
        </div>
        <?php require_once './MVC/Views/instructor_tab.php'?>
    </div>
</div>

<script>
    var selectRadioButton = (name, value) =>{

        $("input[name='"+name+"'][value='"+value+"']").prop('checked', true);
    }
    var user_inf;
    $(document).ready(function () {
        $.ajax({
            method: 'GET',
            headers: {
                'Content-type': 'application/json',
                'Authorization': getCookie('Authorization')
            },
            url: "/../QuizSys/Home/infoUserJWT",
            async: false,
            success: (data) =>{
                var user = JSON.parse(data)['user']

                document.getElementById('username-big').innerHTML = user['username']
                document.getElementById('username-small').innerHTML = user['username']
                document.getElementById('position').innerHTML ='<span class="title mr-2">Chức vụ</span>'+ user['position']
                document.getElementById('more-info').innerHTML = `
                <table class="table table-hover">
                    <tr class="row-info" style="margin-top: 10px">
                        <td class="title"> Email</td>
                        <td class="text-secondary">${user['email']}</td>
                    </tr>
                    <tr class="row-info">
                        <td class="title"> Quốc gia</td>
                        <td class="text-secondary">${user['country']}</td>
                    </tr>
                    <tr class="row-info">
                        <td class="title">Thành phố</td>
                        <td class='text-secondary'>${user['city']}</td>
                    </tr>
                    <tr class="row-info">
                        <td class="title">Số lượng phòng</td>
                        <td class="text-secondary">0</td>
                    </tr>
                    <tr class="row-info">
                        <td class="title">Số lượng đề</td>
                        <td class="text-secondary">0</td>
                    </tr>
                </table>
            `
                document.getElementById('time_join').innerHTML = 'Ngày tham gia '+ user['date_join']

                document.getElementById('first_name').setAttribute('value', user['first_name'])
                document.getElementById('last_name').setAttribute('value', user['last_name'])
                document.getElementById('email').setAttribute('value', user['email'])
                selectRadioButton("gender", user['gender']);
                document.getElementById('city').setAttribute('value', user['city'])
                document.getElementById('country').setAttribute('value', user['country'])
                document.getElementById('organization_name').setAttribute('value', user['organization_name'])
                document.getElementById('position_input').setAttribute('value', user['position'])
            },
            error: (xhr, error) =>{
                console.log(xhr, error)
            }
        })
    })
    const visibleForm = (e) =>{
        e.style.display = 'none'
        const info = document.getElementById('more-info')
        info.style.display = 'none'
        const form_update = document.getElementById('form-update');
        form_update.style.display = 'block'
    }
    const backInfo = () =>{
        const form =  document.getElementById('form-update')
        form.style.display = 'none'
        document.getElementById('more-info').style.display = 'block'
        document.getElementById('btn-edit').style.display = 'block'
    }
    $('#save').click( () =>{
        const email = document.getElementById('email').value
        const first_name  = document.getElementById('first_name').value
        const last_name = document.getElementById('last_name').value
        const city = document.getElementById('city').value
        const country =  document.getElementById('country').value
        const org_name = document.getElementById('organization_name').value
        const position =  document.getElementById('position_input').value
        const gender = $('input[name="gender"]:checked').val();
        const data_post = {
            email:email,
            first_name: first_name,
            last_name: last_name,
            city: city,
            gender: gender,
            country: country,
            organization_name: org_name,
            position: position,
            school_name: '',
            class_name: '',
            id: id
        }
        console.log(data_post)
        $.ajax({
            method: 'POST',
            url: "/../QuizSys/APIUpdateInfo/updateInfo",
            headers:{
                'Content-type': 'application/json',
                'Authorization': getCookie('Authorization')
            },
            data: JSON.stringify(data_post),
            success: (data) =>{
                console.log(data)
                if (data['success'] === true){
                    alert('Thông tin đã được cập nhật!')
                    location.reload()
                }else{
                    console.log(data['mess'])
                }

            },
            error: (xhr, error) =>{
                console.log(xhr, error)
            }
        })
        return false
    })
</script>