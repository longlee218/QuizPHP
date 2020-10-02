<?php include_once './MVC/Views/navbar_student.php'?>
<style>

</style>
<body>
    <div class="container mt-5">
        <div class="row">
           <div class="col-4">
               <input class="form-control" oninput="searchQuiz(this.value)" placeholder="Tìm kiếm đề..">
           </div>
        </div>
        <div class="row" name="list-quiz" id="list-quiz"></div>
    </div>

</body>

<script>

    const grade_data = {
        1: 'Trung học',
        2: 'Đại học',
        3: 'Doanh nghiệp',
        4: 'Khác'
    };

    function getDetail() {
        const segment_str = window.location.pathname;
        const segment_array = segment_str.split( '/' );
        segment_array.splice(0,4);
        return segment_array;
    }

    const id_room =  getDetail()[0];
    localStorage.setItem('id_room', id_room);
    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: '/../QuizSys/APIThread/queryQuiz/'+id_room,
            headers:{
                'Content-type': 'application/json',
                'Authorization': getCookie('Authorization')
            },
            success: function (data) {
                console.log(data)
                if (data['success'] === true){
                    if(data['data'].length === 0){
                        $('#list-quiz').html('<h2>Không có đề</h2>');
                    }
                    console.log(data['data']);
                    $.each(data['data'], function (index, value) {
                        $('#list-quiz:last-child').append(`
                            <div class="col-sm-4 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Đề: ${value['title']}</h4>
                                        <p class="card-text">Môn: ${value['subject']}</p>
                                        <p> <small class="text-muted">Trình độ: ${grade_data[value['grade']]}</small></p>
                                        <button onclick="startQuiz(this)"  id=${value['id']} class="btn btn-outline-primary">Kiểm tra</button>
                                    </div>
                                <div class="card-footer">
                                     <small class="text-muted">Lần cập nhật cuối ${value['update_at']} </small>
                                </div>
                                </div>
                            </div>

                        `)
                    })
                }
            },
            error: function (xhr, error) {
                console.log(xhr, error);
            }
        })
    })

    $(document).ready(function () {
        $.ajax({
            type: 'GET',
            url: '/../QuizSys/APIUser/findInfoUserByRoom/'+id_room,
            headers:{
                'Content-type': 'application/json',
                'Authorization': getCookie('Authorization')
            },
            success: function (data) {
                console.log(data);
            },
            error: function (xhr, error) {
                console.log(xhr, error);
            }
        })
    })

    function searchQuiz(value) {
        console.log(value)
        $.ajax({
            type: 'GET',
            url: '/../QuizSys/APIThread/searchQuizTitle/'+id_room+'/'+value,
            headers: {
                'Content-type': 'application/json',
                'Authorization': getCookie('Authorization'),
            },
            success: function (data) {
                if (data['success'] === true){
                    $('#list-quiz').empty().html('');
                    if (data['data'].length > 0){
                        $.each(data['data'], function (index, value) {
                            $('#list-quiz:last-child').append(`
                            <div class="col-sm-4 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Đề: ${value['title']}</h4>
                                        <p class="card-text">Môn: ${value['subject']}</p>
                                        <p> <small class="text-muted">Trình độ: ${grade_data[value['grade']]}</small></p>
                                        <a href="/../QuizSys/QuizPage/Test/${value['id']}"  class="btn btn-outline-primary" id="${value['id']}">Kiểm tra</a>
                                    </div>
                                <div class="card-footer">
                                     <small class="text-muted">Lần cập nhật cuối ${value['update_at']} </small>
                                </div>
                                </div>
                            </div>

                        `)
                        })
                    }else{
                        $('#list-quiz').html('<h2>Không tìm thấy kết quả</h2>');
                    }
                }
            }
        })

    }
    function startQuiz(e) {
        console.log(user_info)
        const local = {
            user_id: user_info['id'],
            thread_id: e.id,
            questions: []
        }
        const bangkok = new Date().toLocaleString("en-US", {timeZone: "Asia/Bangkok"});
        window.localStorage.setItem('timeStart', (new Date(bangkok)).toISOString())
        window.localStorage.setItem('data', JSON.stringify(local))
        window.location.href = "/../QuizSys/QuizPage/Test/"+e.id

    }
</script>
