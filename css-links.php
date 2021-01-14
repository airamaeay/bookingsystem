
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css"> -->
  
    <link rel="stylesheet" href="css/fonts.css">
    
    <link rel="stylesheet" href="vendor/timepicker/timepicker.css">
    
    <link rel="stylesheet" href="vendor/weekline/styles/cleanslate.css" />
    <link rel="stylesheet" href="vendor/weekline/styles/jquery.weekLine.css" />
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <style type="text/css">
        .logo-side-bar{
            width: 54px;
            margin-right: -11px;
            margin-top: 1px;
            margin-left: -28px;
        }
        .register-select{
            font-size: .8rem;
            border-radius: 10rem;
            height: 50px;
            padding-left: 19px;
            width: 95%;
            margin: 0px auto;
            cursor:pointer;
        }
        .services-select{
            cursor:pointer;
            height: 42px;
            font-size: 16px;
            padding-left: 12px;
            margin-bottom: -13px;
        }
        .bg{
            background-image: url(img/staffs-bg.png);
            top: 0px;
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            background-attachment: fixed;
            background-position: center center;
            background-size: cover;
        }
        .card{
            background-color: rgba(255,255,255,0.87);
        }
        .file-label{
            border-radius: 10rem;
            height: 47px;
            padding: 12px 17px;
            font-size: 14px;
            color: #90929f;
            cursor:pointer;
        }
        .custom-file-input{
            cursor:pointer !important;
        }
        .custom-file{
            margin-bottom:9px;
        }
        .custom-file-input:lang(en)~.custom-file-label::after{
            content: "Browse";
            border-top-right-radius: 90px;
            border-bottom-right-radius: 90px;
            height: 47px;
            top: -1px;
            right: -1px;
            padding: 12px 27px 12px 21px;
            border: 1px solid #d1d3e2;
            font-size: 14px;
            color: #90929f;
            cursor:pointer;
        }
        .hint{
            font-size: 12px;
            position: relative;
            left: 19px;
        }
        .user-avatar{
            width: 32px;
            height: 32px;
            border-radius: 999px;
            background-position: center top;
            background-size: cover;
        }
        .messages .user-avatar{
            width: 40px;
            height: 40px;
        }
        .chooseWeek {
            margin:8px 6px 0px !important;
        }
        .chooseWeek > a,
        .chooseWeek > a.selectedDay{
            background: unset !important;
            padding: 10px !important;
            margin-right: 2px !important;
            margin-left: 2px !important;
            box-sizing: border-box;
            border:none !important;
        }
        .weekDays a.selectedDay{
            color: white !important;
            background: #1cc88a !important;
            border-radius: 7px !important;
        }
        
        .chooseWeek > a:hover,
        .weekDays a:first-child:hover{
            border:none !important;
            color: white !important;
            background: #1cc88a !important;
            padding: 10px !important;
            border-radius: 7px !important;
        }
        .weekDays a:last-child:not(.selectedDay):not(:hover){
            border:none !important;
            padding: 10px !important;
        }
        .weekDays a:first-child:not(.selectedDay):not(:hover){
            background: unset !important;
            padding: 10px !important;
            margin-right: 2px !important;
            margin-left: 2px !important;
            box-sizing: border-box;
            border: none !important;
        }
        .ui-timepicker-standard a{
            border: 1px solid transparent;
            display: block;
            padding: .2em .4em;
            text-decoration: none;
            font-size: 16px;
            color: #777;
        input    font-family:Nunito,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji" !important;
        }
        .weekDays a{
            margin-bottom: 8px !important;
            display: block !important;
            float: left !important;
            font-family:Nunito,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji" !important;
        }
        .days{
            border: 1px solid #d1d3e2;
            margin-bottom: 7px;
            border-radius: 6px;
            display: flex;
            justify-content: center;
        }
        .ui-timepicker-standard .ui-state-hover{
            color: #eee;
            cursor: pointer;
            border-radius: 5px;
            background: #1cc88a;
            border: 1px solid #bbb;
        }
        .ui-timepicker-standard{
            border: 1px solid #d1d3e2;
            border-radius: 6px;
            margin-top:3px;
        }
        .ui-timepicker-standard .ui-menu-item{
            width: 99% !important;
        }
        .bg-photo{
            height: 195px;
            background-size: cover !important;
            margin-bottom: 16px;
        }
        .timepick_inputs input{
            margin-bottom:5px;
        }
        .show-schedules{
            background: #fbfbfb;
            padding: 5px 12px 7px 13px;
        }
        .show-schedules > div > div{
            width:135px;
            float:left;
        }
        .show-schedules > div > i{
            font-size:14px;
            color:#bbb;
        }
        .show-schedules > div > span{
            font-size:14px;
        }
        .chat-box{
            min-height: 200px;
            width: 100%;
            border: 1px solid #ededed;
            border-radius: 7px;
            position:relative;
            padding-bottom: 52px;
        }
        .input-message{
            position:absolute;
            bottom:0px;
            border-bottom:none;
            border-left:none;
            border-right:none;
            border-top:1px solid #ededed;
            border-top-left-radius:0px;
            border-top-right-radius:0px;
        }
        .send-button{
            bottom: 2px;
            position: absolute;
            right: 15px;
            cursor: pointer;
            font-size: 20px;
        }
        .message-note{
            font-size:14px;
            margin-top:3px;
            color:#ccc;
        }
        .right-message{
            background: #4e73df;
            color: white;
            float: right;
            max-width: 267px;
            margin-right: 15px;
            margin-top: 12px;
            border-radius: 10px;
            padding: 8px 13px 8px 12px;
        }
        .left-message{
            background: #f2f2f2;
            color: #858585;
            float: left;
            max-width: 267px;
            margin-left: 14px;
            margin-top: 10px;
            border-radius: 11px;
            padding: 8px 15px 8px 16px;
        }
        .badge-message-center{
            font-size: 12px;
            padding: 5px 9px;
            margin-top: 7px;
            margin-bottom: 7px;
        }
        .status-lines{
            width: 100%;
            height: 1px;
            background: #eee;
        }
        .input-message::-webkit-input-placeholder { /* Chrome/Opera/Safari */
        color: #bbb;
        }
        .input-message::-moz-placeholder { /* Firefox 19+ */
        color: #bbb;
        }
        .input-message:-ms-input-placeholder { /* IE 10+ */
        color: #bbb;
        }
        .input-message:-moz-placeholder { /* Firefox 18- */
        color: #bbb;
        }
        .status.badge{
            text-align: unset;
            white-space: unset;
            font-size: 14px;
            line-height: 18px;
            letter-spacing: 2px;
            padding: 7px 8px 7px 11px;
        }
        .rating{
            cursor:pointer;
        }
        .message-date{
            text-transform: uppercase;
            letter-spacing: 0.7px;
            font-size: 10px;
        }
        .message-date.left{
            padding-left: 2px;
            margin-top: 3px;
            color: #aaa;
        }
        .message-date.right{
            margin-top: 3px;
            color: #ccc;
            text-align: right;
        }
        .message-avatar-holder.left{
            width: 20px;
            float: left;
            margin-top: 12px;
            margin-left: 3px;
        }
        .message-avatar-holder.right{
            float: right;
            margin-left: -12px;
            margin-right: 4px;
            margin-top: 14px;
        }
        .chat-box .status-indicator{
            position: relative;
            top: -10px;
            left: 23px;
            height: 12px;
            width: 12px;
            border-radius: 18px;
            border: 2px solid white;
        }
        .logo-side-bar{
            width: 54px;
            margin-right: -1px;
            margin-top: 1px;
            margin-left: 0px;
        }
    </style>