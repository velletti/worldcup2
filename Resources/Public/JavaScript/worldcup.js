  jQuery(document).ready(function() {
  $("FORM.worldcupform-modal").submit( function(e) {
    e.preventDefault();


    let ajaxCurrentPageUid = parseInt($('meta[name=pageUid]').attr('content'));
    let gameId = $(this).data("game")
    let goal1  = $("#goal1-" + gameId).val() ;
    let goal2  = $("#goal2-" + gameId).val() ;
    if(  $("#worldcup-modal-" + gameId).hasClass("in") ) {
      $(".close.worldcupmodal").click() ;
      //  alert("hello Form " + formid + "\n\nGame:" + gameId + " | " +  goal1 + ":" + goal2) ;
      $.ajax( {
        url: '/index.php' ,
        data: '&tx_worldcup2_ajax[game]=' + gameId +  "&tx_worldcup2_ajax[pid]=" + ajaxCurrentPageUid + '&tx_worldcup2_ajax[goal1]=' +  goal1 +  '&tx_worldcup2_ajax[goal2]=' +  goal2 ,

        before: function() {
          $("#worldcup-result-" + gameId + " .worldcup_team1").html( "..") ;
          $("#worldcup-result-" + gameId + " .worldcup_team2").html( ".." ) ;
          // $("#worldcup-result-" + gameId ).html("#####") ;
          // $("#worldcup-result-" + gameId ).html("<span class='fa fa-spinner fa-spin'></span>") ;
        } ,
        success: function(response) {
          let json = JSON.parse(response)
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
          let json = JSON.parse(response)
          $("#worldcup-result-" + gameId ).html( json.result ) ;
          alert("error" + json.msg);
          location.reload() ;
        },
        error: function(response) {
          let json = JSON.parse(response)
          $("#worldcup-result-" + gameId ).html( json.result ) ;
          alert("Undefined error");
          location.reload() ;
        }
      })
    }

  })
}) ;
