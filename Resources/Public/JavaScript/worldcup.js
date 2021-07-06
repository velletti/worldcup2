  jQuery(document).ready(function() {
    let ajaxCurrentPageUid = parseInt($('meta[name=pageUid]').attr('content'));
    if( $("#worldcupCurrentUser").data("userid")) {
      let userbetpid = $("#worldcupCurrentUser").data("userbetpid")
      let gamepid = $("#worldcupCurrentUser").data("pid")
      $.ajax( {
        url: '/index.php' ,
        dataType: "json",
        cache: false,
        data: '&tx_worldcup2_ajax[ranking]=' + $("#worldcupCurrentUser").data("start")
               +  "&tx_worldcup2_ajax[pid]=" + gamepid +  "&tx_worldcup2_ajax[userbetpid]=" + userbetpid ,

        before: function() {
        } ,
        success: function(response) {
          let json = response.result ;
          if(json && json.username) {
            $("#worldcupCurrentUser span[data-value='username']").html(json.username) ;
          } else {
            $("#worldcupCurrentUser").addClass("hide") ;
          }
          if(json && json.betcount && json.betcount > 0 ) {
          } else {
            $("#worldcupCurrentUser").addClass("hide") ;
          }


          if(json && json.userid) {
            $("DIV.worldcup-ranking[data-useruid='" + json.userid + "']").addClass( "alert").addClass( "alert-info")
              .addClass( "mt-0").addClass( "mb-0").addClass( "p-0").addClass( "pt-1");
          }

          if(json && json.points) {
            $("#worldcupCurrentUser span[data-value='userpoint']").html(json.points);
          } else {
            $("#worldcupCurrentUser span[data-value='userpoint']").html("0");
            $("#worldcupCurrentUser").addClass("hide") ;
          }
          if(json && json.position) {
            $("#worldcupCurrentUser span[data-value='userpos']").html(json.position);
          } else {
            $("#worldcupCurrentUser span[data-value='userpos']").html( "-");
            $("#worldcupCurrentUser").addClass("hide") ;
          }
          if(json && json.betsteam1) {
            $("#worldcupCurrentUser span[data-value='userbet1']").html(json.betsteam1);
          } else {
            $("#worldcupCurrentUser span[data-value='userbet1']").html("0");
          }
          if(json && json.betsteam2) {
            $("#worldcupCurrentUser span[data-value='userbet2']").html(json.betsteam2);
          } else {
            $("#worldcupCurrentUser span[data-value='userbet2']").html("0");
          }
          if(json && json.betstotal) {
            $("#worldcupCurrentUser span[data-value='userbettotal']").html(json.betstotal);
            let diff = Math.abs( parseInt($("#worldcupCurrentUser span[data-value='goalstotal']").html() )
                                 - parseInt(json.betstotal)) ;
            $("#worldcupCurrentUser span[data-value='diff']").html(diff) ;
          } else {
            $("#worldcupCurrentUser span[data-value='diff']").html("0")
          }

        },
        401: function(response) {
          alert("error " + response);
        },
        error: function(response) {
          alert("Undefined error");
        }
      })
    }


    $("FORM.worldcupform-modal").submit( function(e) {
      e.preventDefault();

      let gameId = $(this).data("game")
      let goal1  = $("#goal1-" + gameId).val() ;
      let goal2  = $("#goal2-" + gameId).val() ;
      if(  $("#worldcup-modal-" + gameId).hasClass("in") ) {
        $(".close.worldcupmodal").click() ;
        $.ajax( {
          url: '/index.php' ,
          dataType: "json",
          cache: false,
          data: '&tx_worldcup2_ajax[game]=' + gameId +  "&tx_worldcup2_ajax[pid]=" + ajaxCurrentPageUid + '&tx_worldcup2_ajax[goal1]=' +  goal1 +  '&tx_worldcup2_ajax[goal2]=' +  goal2 ,

          before: function() {
            $("#worldcup-result-" + gameId + " .worldcup_team1").html( "..") ;
            $("#worldcup-result-" + gameId + " .worldcup_team2").html( ".." ) ;
          } ,
          success: function(response) {
            let json = (response) ;
            if(json && json.status) {
              $("#worldcup-msg").html(json.status  + ": msg: Bet " + json.bet  + " " + json.msg + " | gameId:" + gameId + " = " + json.input.goal1 + ":" + json.input.goal2) ;
              if( parseInt(json.status) === 200 ) {
                $("#worldcup-result-" + gameId + " .worldcup_team1").html( json.input.goal1 ) ;
                $("#worldcup-result-" + gameId + " .worldcup_team2").html( json.input.goal2 ) ;
                $("#worldcup-game-" + gameId + " .worldcup-points .btn").removeClass("btn-primary").addClass("btn-default") ;
              } else {
                $("#worldcup-result-" + gameId ).html( json.result ) ;
                alert("error" + json.msg);
                location.reload() ;
              }
            }

          },
          401: function(response) {
            let json = (response) ;
            $("#worldcup-result-" + gameId ).html( json.result ) ;
            alert("error" + json.msg);
            location.reload() ;
          },
          error: function(response) {
            let json = (response) ;
            $("#worldcup-result-" + gameId ).html( json.result ) ;
            alert("Undefined error");
            location.reload() ;
          }
        })
      }

    })
}) ;
