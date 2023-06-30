
const emergency_funds = {
    temp:{},
    dom: function () {
      const elem = $('.modal#myModal');
      const children = elem.children();
      return {
        elem,children,
        head:children.find('.modal-header'),
        body:children.find('.modal-body'),
        foot:children.find('.modal-footer')
      }
    },
    open: async function(conf){
      console.log(conf);
      if(conf && conf.a && conf.r) {
        const aa= conf.a;
        if(aa) {
          this.temp['a']=aa? aa:0;
          this.temp['r']=conf.r?conf.r:null;
          this.changeForm('init',this.dom());
          const {elem}= this.dom();
          elem.modal({
            backdrop: 'static',
          })
          this.temp['tac'] = await fetch(`${conf.r}ecashloan/termsandconditions`)
          .then(response => response.text());
          elem.modal('show');
          this.handleInit(this.dom());
        }
      }
    },  
    handleInit:function(e){
      const {foot} = e
      foot.find('button').click((evt)=>{
        if(evt.currentTarget.id=='ef_avail') {
          this.changeForm('sla',e);
          this.handleSelectValue(e);
        }
      })
    },
    handleSelectValue:function(element) {
      const {body,foot} = element
      body.find(':radio').click((evt)=>{
        $('#ef_proceed').attr('disabled',false);
      })
      foot.find('button').click((evt)=>{
        if(evt.currentTarget.id=='ef_proceed') {
          this.temp['ef_hsv_templv'] = Number(body.find(':checked').val());
          this.changeForm('sum',element);
          this.handleSummary(element);
        }
      })
    },
    handleSummary:function(element){
      const {foot} = element;
      foot.find('button').click((evt)=>{
        if(evt.currentTarget.id=='ef_sla_back') {
          this.changeForm('sla',element);
          this.handleSelectValue(element);
        } else if(evt.currentTarget.id=='ef_proceed') {
          this.changeForm('tos',element);
          this.handlePreTOS(element);
        }
      })
    },
    handlePreTOS:function(element){
      console.log('pret')
      const {foot,body}=element;
      foot.find('button').click((evt)=>{
        if(evt.currentTarget.id=='ef_tos_accept') {
          if(body.children().find('#tpassword').val().trim()) {
            this.finish();
          } else {
            alert('Please input password');
          }
        } else if (evt.currentTarget.id=='ef_sla_back') {
          this.changeForm('sum')
          this.handleSummary(element);
        }
      })
      body.children().find('#tosbox').scroll(function(){
        if($(this).scrollTop()+$(this).innerHeight() >=this.scrollHeight) {
          body.children().find("#acceptos").attr('disabled',false);
        }
      })
      body.children().find('#acceptos').change(function(){
        foot.find("#ef_tos_accept").attr('disabled',!this.checked);
      })
    },
    finish:function() {
      const elem = this.dom();
      this.temp={...this.temp,p:elem.body.children().find('#tpassword').val()}
      const data = this.temp;
      const url = `${this.temp.r}emergencyfunds/submit_loan`;
      $.ajax({
          type: "POST",  
          url,data, 
          success: (v)=>{  
            const a = JSON.parse(v);
            if(a.S==0) {
              this.changeForm('end_invalid',elem,{msg:a.M})
              elem.foot.find('#ef_sla_back').click(function(){
                emergency_funds.changeForm('tos',elem);
                emergency_funds.handlePreTOS(elem);
              })
            } else if(a.S==1) {
              emergency_funds.changeForm('end_success',elem,{fres:a,msg:a.M});
            } else {
              this.changeForm('end',elem,{msg:a.M})
            }
          },
          error:(XMLHttpRequest, textStatus, errorThrown) => { 
            console.log("Status: " + textStatus+"\n"+"Error: " + errorThrown)
            this.changeForm('end',elem,{msg:'Unable to reach Emergency Fund Server ERRC:EMF_1'})
          }       
      });
    },
    changeForm:function(mode,element,data={}) {
      const {elem,head,body,foot} = this.dom()
      const lvlist = this.temp['a'];
      function h4(v) {return  `<h4>${v}</h4>`}
      function div(v) {return  `<div>${v}</div>`}
      function p(v) {return  `<p>${v}</p>`}
      function button(v) {
        if(typeof v == 'object') {
          const h = v.h? v.h:'';
          const attr = v.attr? v.attr:'';
          return `<button ${attr}>${h}</button>`
        } else {
          return `<button>${v}</button>`
        }
      }
      function form(v){return `<form>${v}</form>`}
      function colH(v){
        if(typeof v == 'object') {
          const h = v.h? v.h:'';
          const attr = v.attr? v.attr:'';
          return `<th ${attr}>${h}</th>`
        } else {
          return `<th>${v}</th>`
        }
      }
      function col(v,attr=''){return `<td ${attr}>${v}</td>`}
      function row(v){return `<tr>${v}</tr>`}
      function table(v){return `<table class="table">${v.join('')}</table>`}
      const btnDefault= `class="btn btn-default pull-left"`;
      const btnSuccess= `class="btn btn-success pull-left"`;
      const dismiss = `data-dismiss="modal"`;
      const closeBtn = button({h:'Close',attr:`id="ef_close" ${btnDefault} ${dismiss}`});
      const backBtn = button({h:'Back',attr:`id="ef_sla_back" ${btnDefault}`});
      switch (mode) {
        case 'init':
          head.html(h4('Avail Emergency Fund'));
          body.html(div(p(`Running out of E-cash? Avail an extra E-cash from Unified Emergency Fund in just a few clicks.`)))
          foot.html(closeBtn+
          button({h:'Proceed',attr:`id="ef_avail" ${btnDefault} ${dismiss}`}))
        break;
        case 'sla':
          const loanvalues = lvlist.split('|');
          const output = loanvalues.map(loanvalue => div(`<input type="radio" id="ef_${loanvalue}" name="efval" value="${loanvalue}"><label for="efval">PHP ${loanvalue}</label>`))
          const trueval =output?div(p(`Please choose the amount you want to avail.`)+form(output.join(''))):div(p('Something Went Wrong ERRC:EMF_0'));
          head.html(h4('Step 1. Select Fund Amount'));
          body.html(trueval);
          foot.html(closeBtn+button({h:'Next',attr:`id="ef_proceed" ${btnDefault} disabled`}))
        break;
        case 'sum':
          const loan_value = this.temp['ef_hsv_templv']?this.temp['ef_hsv_templv']:0;
          const interest = [Number(loan_value*0.01),Number(loan_value*0.02),Number(loan_value*0.03)];
          const totalPayable = interest.map(value => value+loan_value);
          const rows = [
            row(colH({h:'EMERGENCY FUND SUMMARY:',attr:'colspan=4 style="text-align:center "'})),
            row(colH('E-cash Availed:')+col(`PHP ${loan_value.toLocaleString('en')}`,'colspan="3"')),
            row(colH('Fund Usage Duration:')+col(`1 - 7 Days`)+col('8 - 14 Days')+col('15 - 30 Days')),
            row(colH('System Fee:')+col(`PHP ${interest[0].toLocaleString('en')}`)+col(`PHP ${interest[1].toLocaleString('en')}`)+col(`PHP ${interest[2].toLocaleString('en')}`)),
            row(colH('Total Amount Due:')+col(`PHP ${totalPayable[0].toLocaleString('en')}`)+col(`PHP ${totalPayable[1].toLocaleString('en')}`)+col(`PHP ${totalPayable[2].toLocaleString('en')}`)),
          ]

          head.html(h4('Step 2. Review your Transaction'));
          body.html(div(table(rows)));
          foot.html(backBtn+button({h:'Confirm',attr:`id="ef_proceed" ${btnDefault}`}))
        break;
        case 'tos':
          head.html(h4('Step 3. Proceed'));
          body.html(div(h4('Read the Terms and Conditions Carefully')+`
            <div>
              <div style="border:1px solid black; border-radius:5px;overflow:scroll;height:150px;" id="tosbox">
               ${this.temp['tac']}
              </div>
              <div>
                <input type="checkbox" name="acceptos" id="acceptos" disabled> I Aggree and Accept the <a href="${this.temp['r']}ecashloan/termsandconditions" target="_blank">Terms and Conditions</a>
              </div>
              <div>
                <label for="tpassword">Transaction Password</label>
                <input type="password" name="tpassword" id="tpassword">
              </div>
            </div>
          `));
          foot.html(backBtn+button({h:'Accept',attr:`id="ef_tos_accept" disabled ${btnDefault}`}))
        break;
        case 'end':
        //Display Tracking Number
        //Receipt Button - Download / Open
          msg = data.msg ? data.msg : 'Operation Finished Unexpectedly.';
          head.html(h4('Emergency Fund'));
          body.html(div(p(msg)));
          foot.html(closeBtn)
        break;
        case 'end_success':
          msg = data.msg ? data.msg : 'Operation Finished Unexpectedly.';
          head.html(h4('Emergency Fund'));
          body.html(div(p(msg))/*+div(p(`Tracking Number: ${data.fres.TN}`))*/);
          foot.html(closeBtn+`<a href="${data.fres.URL}" target="_blank">`+button({h:'Print Receipt',attr:`id="print_receipt" ${btnSuccess}`})+`</a>`)
        break;
        case 'end_invalid':
          msg = data.msg ? data.msg : 'Operation Finished Unexpectedly.';
          head.html(h4('Emergency Fund'));
          body.html(div(p(msg)));
          foot.html(backBtn+closeBtn)
        break;
        default:
        break;
      }
    }
  }
const ecashloanApp = {
  calculate: function(input){
    const newVal=$(input).val();
    const loanValue = $('table.ecashLoanSummary tBody .loanedAmount .loanvalue')
    const interest = [
                      $('table.ecashLoanSummary tBody .loanInterest .interest1'),
                      $('table.ecashLoanSummary tBody .loanInterest .interest2'),
                      $('table.ecashLoanSummary tBody .loanInterest .interest3'),
                      ]
    const totalPayable = [
      $('table.ecashLoanSummary tBody .totalPayable .sum1'),
      $('table.ecashLoanSummary tBody .totalPayable .sum2'),
      $('table.ecashLoanSummary tBody .totalPayable .sum3'),
    ]
    loanValue.html(newVal)
    interest[0].html(`${newVal*0.01}`)
    interest[1].html(`${newVal*0.02}`)
    interest[2].html(`${newVal*0.03}`)
    totalPayable[0].html(Number(newVal)+(newVal*0.01))
    totalPayable[1].html(Number(newVal)+(newVal*0.02))
    totalPayable[2].html(Number(newVal)+(newVal*0.03))
    this.showDetails();
  },
  showDetails:function(){
    $('.summaryContainer,.transpassContainer,.submitECLContainer').show()
  },
  check: function(e){
    const elem = $(e);
    if(elem.scrollTop()+elem.innerHeight() >=e.scrollHeight) {
      $("#agreeTOS").attr('disabled',false);
    }
  },
  allowSubmit:function(e){
    $("#submitECL").attr('disabled',!e.checked);
  },
  statusAlert:function(msg=''){
    const elem = $('.modal#myModal');
    const children = elem.children();
    const part = {
      elem,children,
      head:children.find('.modal-header'),
      body:children.find('.modal-body'),
      foot:children.find('.modal-footer')
    }
    $.post(window.location.origin+'/Emergencyfunds/ecashLoanBal',function(data){
      data = JSON.parse(data)
      switch(data.S) {
        case 0:
          msg=`${data.M} ${data.BAL}`;
        break;
        case 1:
          msg=`${data.M}`;
          $('#availecl').children().find('a').attr('href',window.location.origin+'/ecashloan/avail').attr('onClick','');
          $('#ecl_lp').children().find('a').attr('href',window.location.origin+'/ecashloan').attr('onClick','');
        break;
        case 2:
          msg=`${data.M} ${data.BAL}`;
        break;
      }
      part.head.html(`<H4>Emergency Fund</H4>`);
      part.body.html(`<div>${msg}</div>`);
      part.foot.html(`<div><button class="btn btn-default pull-left" data-dismiss="modal">Close</button></div>`);
      elem.modal('show');
    })
  },
  notEligible:function() {
    const elem = $('.modal#myModal');
    const children = elem.children();
    const part = {
      elem,children,
      head:children.find('.modal-header'),
      body:children.find('.modal-body'),
      foot:children.find('.modal-footer')
    }
    part.head.html(`<H4>Emergency Fund</H4>`);
    part.body.html(`<div>Sorry, this account is not eligible to use the Emergency Fund. For more information, read the following <a href="${window.location.origin}/ecashloan/termsandconditions" target="_blank"><b>Terms and Conditions<b></a>.</div>`);
    part.foot.html(`<div><button class="btn btn-default pull-left" data-dismiss="modal" onclick=ecashloanApp.destroynoneligible()>Close</button></div>`);
    elem.modal('show');
  },
  destroynoneligible:function(){
    var modal1 = $('.modal:visible')[0]
    var modal2 = $('.modal:visible')[1]
    var m1b = $(modal1).children().find('.modal-body');
    var m2b = $(modal2).children().find('.modal-body');
    $(modal1).modal('hide')
  },
  displayMessage:function(msg){
    const elem = $('.modal#myModal');
    const children = elem.children();
    const part = {
      elem,children,
      head:children.find('.modal-header'),
      body:children.find('.modal-body'),
      foot:children.find('.modal-footer')
    }
    part.head.html(`<H4>Emergency Fund</H4>`);
    part.body.html(`<div>${msg}</div>`);
    part.foot.html(`<div><button class="btn btn-default pull-left" data-dismiss="modal">Close</button></div>`);
    elem.modal('show');
  }
}
  // ERRC:EMF_0
  // Received bad value.
  // ERRC:EMF_1
  // sending transaction details:
  // Failed to receive response from server.+