waitingDialog.show('Please wait..', { dialogSize: 'sm', progressType: 'primary' });
window.scrollTo(0, 0)
const rootElement = document.getElementById('root')
const { Upload, Icon, Divider, Card, Steps, Button, Row, Col, Alert, Tag, Input, Table, Form, Modal, Select, message, Spin, Tabs } = window.antd
const moment = window.moment
const { Step } = Steps;
const { TabPane } = Tabs;
const InputGroup = Input.Group;
const { TextArea } = Input;
const { Option } = Select;

const onlyNumber = (e) => {
  var regexp = /[^0-9]*/g;

  const input = e.target.value
  return input.replace(regexp, '')
}

const noBeginningSpace = (e) => {
  const input = e.target.value
  if (input === " ") {
    return "";
  }
  return input
}

const onlyLetter = (e) => {
  var regexp = /[^a-zA-Z- ]*$/;
  const input = e.target.value
  if (input === " ") {
    return "";
  }
  return input.replace(regexp, '')
}

const cantDropAndPaste = (e) => {
  e.preventDefault()
  return false;
}

class CashCard extends React.Component {
  constructor() {
    super()

    this.state = {
      current: 0,
      sender: {},
      beneficiary: {},
      idType: [],
      trNumber: "",
      amount: 0,
      id: {},
      summaryDetails: {}
    }
  }

  render() {
    const { current, idType } = this.state
    return (
      <Row>
        <Row>
          <Col offset={2} style={{ marginTop: 20, marginBottom: 20 }} span={12}>
            <Steps current={current}>
              <Step title="Amount" />
              <Step title="Sender" />
              <Step title="Sender ID" />
              <Step title="Beneficiary" />
              <Step title="Summary" />
            </Steps>
          </Col>
        </Row>
        <Row>
          <Col offset={2} span={12}>
            {this.renderStep()}
          </Col>
        </Row>
      </Row>
    )
  }

  componentDidMount() {
    waitingDialog.hide();
    this.fetchId()
  }

  done = () => {
    this.setState({
      current: 0,
      sender: {},
      beneficiary: {},
      trNumber: "",
      amount: 0,
      id: {}
    })

  }

  fetchId = async () => {
    let res = await fetch('fetch_secbank_id_types', {
      method: "POST"
    })

    let result = await res.json()
    if (!result.S) {
      return message.error("Error in fetching ID Types")
    }
    this.setState({ idType: result.T_DATA })
  }

  getSenderDetails = (sender) => {
    this.setState({ sender })
  }

  getId = (id) => {
    this.setState({ id })
  }

  getBeneficiaryDetails = (beneficiary) => {
    this.setState({ beneficiary })
  }

  getSummaryDetails = (summaryDetails) => {
    this.setState({ summaryDetails })
  }

  stepProceed = (current) => {
    this.setState({ current })
  }

  getTrNumber = (trNumber) => {
    this.setState({ trNumber })
  }

  getAmount = (amount) => {
    this.setState({ amount })
  }
  renderStep = () => {
    const { current, sender, beneficiary, idType, trNumber, amount, id, summaryDetails } = this.state

    switch (current) {
      case 0:
        return <AmountDetails
          getAmount={this.getAmount}
          stepProceed={this.stepProceed}
        />
      case 1:
        return <Sender
          stepProceed={this.stepProceed}
          sender={sender}
          getSenderDetails={this.getSenderDetails}
        />
      case 2:
        return <Identification
          idType={idType}
          getId={this.getId}
          stepProceed={this.stepProceed}
          sender={sender}
        />
      case 3:
        return <Beneficiary
          stepProceed={this.stepProceed}
          beneficiary={beneficiary}
          getBeneficiaryDetails={this.getBeneficiaryDetails}
        />
      case 4:
        return <SummaryDetails
          idType={idType}
          id={id}
          getSummaryDetails={this.getSummaryDetails}
          sender={sender}
          beneficiary={beneficiary}
          getTrNumber={this.getTrNumber}
          stepProceed={this.stepProceed}
          amount={amount}
        />
      case 5:
        return <SuccessTransaction
          stepProceed={this.stepProceed}
          idType={idType}
          sender={sender}
          summaryDetails={summaryDetails}
          beneficiary={beneficiary}
          trNumber={trNumber}
          done={this.done}
          amount={amount} />
      default:
        break;
    }
  }
}

class Amount extends React.Component {

  state = {
    status: "",
    help: ""
  }

  getAmount = () => {
    this.props.form.validateFields((err, values) => {
      if (err) {
        this.setState({
          help: "Amount Input field is Required",
          status: "error"
        })
      }
      if (!err) {
        const amount = parseInt(values.amount)
        if (amount < 200) {
          this.setState({
            help: "The amount must be greater than 200 but not less than 50,000",
            status: "error"
          })
          return
        } else if (amount > 50000) {
          this.setState({
            help: "The amount must be greater than 200 but not less than 50,000",
            status: "error"
          })
          return
        } else {
          this.props.getAmount(values.amount)
          this.props.stepProceed(1)
        }
      }
    });
  }

  render() {
    const { getFieldDecorator, getFieldValue, } = this.props.form;
    const { status, help } = this.state
    return (
      <Row justify="center" type="flex">
        <Col span={20}>
          <Form>
            <Card
              title="Enter Amount">
              <Row justify="center" type="flex">
                <Col span={12}>
                  <Form.Item
                    help={help}
                    validateStatus={status}
                    label="Amount">
                    {getFieldDecorator('amount', {
                      getValueFromEvent: onlyNumber,
                      rules: [{ required: true, message: 'Please input amount' }],
                    })(
                      <Input
                        placeholder="Amount"
                      />
                    )}
                  </Form.Item>
                </Col>
                <Col align="left" offset={15} span={9}>
                  <Button
                    onClick={this.getAmount}
                    type="primary">
                    Proceed
                    </Button>
                </Col>
              </Row>
            </Card>
          </Form>
        </Col>
      </Row>
    )
  }
}

const AmountDetails = Form.create()(Amount)

class SenderDetails extends React.Component {
  constructor() {
    super()
    this.state = {
      idType: [],
      idSecondary: [],
      isPrimary: "PRIMARY",
      senderName: "",
      accntTable: [],
      validatingStatus: '',
      help: "",
      sender: {},
      modal: false,
      loading: false
    }
  }

  proceed = () => {
    this.props.form.validateFields((err, values) => {
      if (!err) {
        // console.log('Received values of form: ', values, JSON.stringify(values));
        this.props.getSenderDetails(values)
        this.props.stepProceed(2)
      }
    });
  };

  componentDidMount() {
    this.fetchId()
    const { setFieldsValue } = this.props.form
    if (this.props.sender) {
      setFieldsValue(this.props.sender)
    }
  }

  fetchId = async () => {
    let res = await fetch('fetch_secbank_id_types', {
      method: "POST"
    })

    let result = await res.json()
    if (!result.S) {
      return message.error("Error in fetching ID Types")
    }
    this.setState({ idType: result.T_DATA })
    // console.table(result.T_DATA)
  }

  IdOnSelect = (e, opt) => {
    // console.log(e, opt.props.data)
    const { idType } = this.state
    const { setFieldsValue } = this.props.form
    let idSecondary = idType.slice().filter(i => i.secbank_idtype !== "PRIMARY")
    this.setState({ isPrimary: opt.props.data, idSecondary }, () => {
      // console.log(this.state)
    })
    setFieldsValue({ secondaryID: '' })
  }

  searchSender = (e) => {
    var regexp = /[^a-zA-Z- ]*$/;
    const input = e.target.value
    this.setState({ senderName: input.replace(regexp, '') })
  }

  senderSearch = (e) => {
    const input = this.state.senderName

    if (input.length >= 3) {
      this.setState({
        sender: {},
        help: "SEARCHING FOR AVAILABLE SENDER ....",
        validatingStatus: "validating"
      }, () => {
        this.fetchSender(input)
      })

    } else {
      this.setState({
        help: "Must be minimum of 3 Letters to Search",
        validatingStatus: "error"
      })
    }
  }

  fetchSender = async (input) => {
    const body = new FormData()
    body.append('inputSearch', input)
    let res = await fetch('cashcard_get_sender', {
      body,
      method: "POST"
    })

    let result = await res.json()
    this.setState({ help: "", validatingStatus: "" })
    if (!result.S) {
      const help = result.M === "NO MATCH FOUND" ?
        "No match found. Click Add New Sender and fill up the form below." :
        result.M

      this.setState({ accntTable: [], help, validatingStatus: "error" })
      return;
    }
    // console.log(result)
    this.setState({ accntTable: result.result })
  }

  openModal = () => {
    this.setState({ modal: true })
  }

  closeModal = () => {
    this.setState({ modal: false })
  }

  getSender = async (sender) => {

    const { setFieldsValue } = this.props.form
    const { fname, mname, lname, bdate, address } = sender
    await this.setState({
      sender: {
        firstName: fname,
        middleName: mname,
        lastName: lname,
        birthday: bdate,
        address
      }
    })
    await setFieldsValue({
      firstName: fname,
      middleName: mname,
      lastName: lname,
      birthday: bdate,
      address
    })

    window.scrollTo({
      top: 1100,
      behavior: 'smooth',
    });
  }

  handleOk = (e) => {
    e.preventDefault()
    this.props.form.validateFields((err, values) => {
      if (!err) {
        // console.log(values)
        this.addSender({...values,
          inputMname: values.inputMname ? values.inputMname : " "
        })
      }
    });
  }



  validate = (rule, value, callback) => {
    let today = moment().subtract(12, "years").valueOf()

    let value2 = new Date(value);
    value2 = value2.setHours(0, 0, 0, 0);

    let value3 = new Date("1900-12-31");
    value3 = value3.setHours(0, 0, 0, 0);

    // console.log(value2, today, value3)
    if (!value) {
      return callback("Birthdate is Required")
    } else if (value2 >= today) {
      return callback("Sender must 12 years old and above")
    } else if (value2 <= value3) {
      return callback("Dates should start year 1901")
    } else {
      callback()
    }

  }

  inputBdate = (e) => {
    // console.log($(".inputbDate"))
    // console.log(e, e.target.value)
  }

  addSender = async (data) => {
    this.setState({ loading: true })
    const body = new FormData()
    body.append('inputFname', data.inputFname)
    body.append('inputMname', data.inputMname)
    body.append('inputLname', data.inputLname)
    body.append('inputEmail', data.inputEmail)
    body.append('inputMobile', data.inputMobile)
    body.append('selGender', data.selGender)
    body.append('inputBdate', data.inputBdate)
    body.append('inputAddr', data.inputAddr)
    body.append('selCountry', data.selCountry)
    body.append('inputTpass', data.password)

    let res = await fetch('cashcard_new_sender', {
      method: "POST",
      body
    })

    let result = await res.json()
    this.setState({ loading: false })
    if (!result.S) {
      return message.error(result.M)
    }
    this.setState({ modal: false })
    message.success('New Sender Added')
  }

  render() {

    const columns = [
      {
        title: "Loyalty No",
        key: 'loyaltycardno',
        dataIndex: 'loyaltycardno'
      },
      {
        title: "Full Name",
        key: 'fullname',
        dataIndex: 'fullname'
      },
      {
        title: "Birthday",
        key: 'bdate',
        dataIndex: 'bdate'
      },
      {
        title: "Address",
        key: 'address',
        dataIndex: 'address'
      },
      {
        title: "Action",
        render: (text, sender) =>
          <Button
            onClick={() => this.getSender(sender)}
            type="primary">Select</Button>
      }
    ]

    const { getFieldDecorator, setFieldsValue } = this.props.form;
    const { idType, isPrimary, idSecondary, accntTable, sender, senderName, help, validatingStatus, modal, loading } = this.state

    return (
      <Row style={{ marginTop: 20 }} type="flex" justify="space-around" gutter={24}>
        {modal ?
          <Modal
            visible={modal}
            style={{ width: 200 }}
            className="step4-modal"
            footer={null}
            closable={false}
            title="Add New Sender"
          >
            <Spin spinning={loading}>
              <Form onSubmit={this.handleOk}>
                <Row gutter={12}>
                  <Col span={24}>
                    <Form.Item
                      label="First Name">
                      {getFieldDecorator('inputFname', {
                        getValueFromEvent: onlyLetter,
                        rules: [{ required: true, message: 'Please input your First Name' },
                        { pattern: /[^a-zA-Z- ]*$/, message: "Please input valid First Name" },],
                      })(
                        <Input
                          onDrop={cantDropAndPaste}
                          onPaste={cantDropAndPaste}
                          placeholder="First Name" />
                      )}
                    </Form.Item>
                  </Col>
                  <Col span={12}>
                    <Form.Item
                      label="Middle Name">
                      {getFieldDecorator('inputMname', {
                        getValueFromEvent: onlyLetter,
                        rules: [{ required: false, message: 'Please input your Middle Name' },
                        { pattern: "^[A-Za-z]", message: "Please input valid Middle Name" }],
                      })(
                        <Input
                          onDrop={cantDropAndPaste}
                          onPaste={cantDropAndPaste}
                          placeholder="Middle Name (Optional)" />
                      )}
                    </Form.Item>
                  </Col>
                  <Col span={12}>
                    <Form.Item
                      label="Last Name">
                      {getFieldDecorator('inputLname', {
                        getValueFromEvent: onlyLetter,
                        rules: [{ required: true, message: 'Please input your Last Name' },
                        { pattern: "^[A-Za-z]", message: "Please input valid Last Name" }],
                      })(
                        <Input onDrop={cantDropAndPaste} onPaste={cantDropAndPaste} placeholder="Last Name" />
                      )}
                    </Form.Item>
                  </Col>
                  <Col span={24}>
                    <Form.Item
                      label="Address">
                      {getFieldDecorator('inputAddr', {
                        getValueFromEvent: noBeginningSpace,
                        rules: [{ required: true, message: 'Please input your Address' },
                        { max: 50, message: 'Not Greater than 50 Characters' }],
                      })(
                        <Input
                          onDrop={cantDropAndPaste}
                          onPaste={cantDropAndPaste}
                          placeholder="Address" />
                      )}
                    </Form.Item>
                  </Col>
                </Row>
                <Row gutter={12}>
                  <Col span={10}>
                    <Form.Item
                      label="Birthdate">
                      {getFieldDecorator('inputBdate', {
                        validateTrigger: "onChange",
                        initialValue:moment().subtract(12, 'year').format('YYYY-MM-DD'),
                        rules: [{validator:this.validate}],
                      })(
                        <Input readOnly className="inputbDate" 
                          onChange={this.inputBdate}
                          ref={(e) => {
                            $(".inputbDate").daterangepicker({
                              singleDatePicker: true,
                              showDropdowns: true,
                              locale: {
                                format: 'YYYY-MM-DD'
                              },
                              minDate: moment().subtract(100, 'year'),
                              maxDate: moment().subtract(12, 'year'),
                            })

                            $('.inputbDate').on('apply.daterangepicker', (ev, picker) =>{
                              setFieldsValue({inputBdate:picker.endDate.format('YYYY-MM-DD')})
                            });
                          }}
                          placeholder="Birthdate (YYYY-MM-DD)" />
                      )}
                    </Form.Item>
                  </Col>
                  <Col span={6}>
                    <Form.Item
                      label="Gender">
                      {getFieldDecorator('selGender', {
                        rules: [{ required: true, message: 'Please select Gender' }],
                      })(
                        <Select placeholder="Gender" >
                          <Option value="Male">Male</Option>
                          <Option value="Female">Female</Option>
                        </Select>
                      )}
                    </Form.Item>
                  </Col>
                  <Col span={8}>
                    <Form.Item
                      label="Country">
                      {getFieldDecorator('selCountry', {
                        rules: [{ required: true, message: 'Please select Country' }],
                      })(
                        <Select placeholder="Country" >
                          <Option value="Philippines">Philippines</Option>
                          <Option value="Singapore">Singapore</Option>
                          <Option value="Qatar">Qatar</Option>
                        </Select>
                      )}
                    </Form.Item>
                  </Col>
                </Row>
                <Row gutter={12}>
                  <Col span={12}>
                    <Form.Item
                      label="Email">
                      {getFieldDecorator('inputEmail', {
                        getValueFromEvent: noBeginningSpace,
                        rules: [{ required: true, message: 'Please input Email Address!' },
                        { type: "email", message: 'Invalid Email Address' }],
                      })(
                        <Input
                          onDrop={cantDropAndPaste}
                          onPaste={cantDropAndPaste}
                          placeholder="Email" />
                      )}
                    </Form.Item>
                  </Col>
                  <Col span={12}>
                    <Form.Item
                      label="Mobile Number">
                      {getFieldDecorator('inputMobile', {
                        getValueFromEvent: onlyNumber,
                        rules: [{ required: true, message: 'Please input Mobile Number!' },
                        { min: 11, message: 'Mobile Number Must be 11 Digits' },
                        { max: 11, message: 'Mobile Number Must be 11 Digits' }],
                      })(
                        <Input
                          maxLength="11"
                          onDrop={cantDropAndPaste}
                          onPaste={cantDropAndPaste}
                          placeholder="Mobile Number" />
                      )}
                    </Form.Item>
                  </Col>
                </Row>                
                <Form.Item
                  label="Transaction Password">
                  {getFieldDecorator('password', {
                    getValueFromEvent: noBeginningSpace,
                    rules: [{ required: true, message: 'Please input your Transaction Password' }],
                  })(
                    <Input.Password
                      onDrop={cantDropAndPaste}
                      onPaste={cantDropAndPaste}
                      placeholder="Transaction Password" />
                  )}
                </Form.Item>
                <Row type="flex" justify="end" style={{ marginTop: 20 }}>
                  <Col span={12} align="right">
                    <Button
                      onClick={this.closeModal}
                      disabled={loading}
                      className='cancelBtn'>CANCEL</Button>
                  </Col>

                  <Col span={12} align="right">
                    <Button style={{ width: "70%" }}
                      className='proceedBtn'
                      htmlType="submit"
                      type="primary"
                      loading={loading} >CONFIRM</Button>
                  </Col>
                </Row>
              </Form>
            </Spin>
          </Modal> : null}
        <Col align="left" span={20}>
          <Spin spinning={(validatingStatus === "validating")}>
            <Card>
              <Button onClick={this.openModal} type="primary" icon="plus">
                Add New Sender
            </Button>
            </Card>
            <Card title="Search Sender">
              <Col span={8}>
                Search Sender:
              </Col>
              <Col span={16}>
                <Form.Item
                  validateStatus={validatingStatus}
                  help={help}
                >
                  <Input.Search
                    value={senderName}
                    onChange={this.searchSender}
                    onSearch={this.senderSearch}
                    enterButton
                    onDrop={cantDropAndPaste}
                    onPaste={cantDropAndPaste}
                    placeholder="Search Sender Name" />
                </Form.Item>
              </Col>
            </Card>
            {accntTable.length ?
              <Card title="Select Sender">
                <Table columns={columns} dataSource={accntTable} />
              </Card> : null}
          </Spin>
        </Col>
        {sender.hasOwnProperty('firstName') ?
          <Col align="center" span={20}>
            <Card
              title={
                <Row>
                  <Col align="left" span={12}>
                    Sender Details
                  </Col>
                  <Col align="right" span={12}>
                    <Button
                      onClick={() => this.setState({ sender: {} })}
                      icon="close"
                      type="danger"
                      shape="circle" />
                  </Col>
                </Row>
              }>
              <Form>
                <Col align="left" span={12}>
                  <Form.Item
                    label="First Name:">
                    {getFieldDecorator('firstName', {
                      rules: [{ required: true, message: 'Please input your First Name!' }],
                    })(
                      <Input
                        disabled={true}
                        placeholder="First Name"
                      />,
                    )}
                  </Form.Item>
                </Col>
                <Col align="left" span={12}>
                  <Form.Item
                    label="Middle Name:">
                    {getFieldDecorator('middleName', {
                      rules: [{ required: true, message: 'Please input your Middle Name!' }],
                    })(
                      <Input
                        disabled={true}
                        placeholder="Middle Name"
                      />,
                    )}
                  </Form.Item>
                </Col>
                <Col align="left" span={12}>
                  <Form.Item
                    label="Last Name:">
                    {getFieldDecorator('lastName', {
                      rules: [{ required: true, message: 'Please input your Last Name!' }],
                    })(
                      <Input
                        disabled={true}
                        placeholder="Last Name"
                      />,
                    )}
                  </Form.Item>
                </Col>
                <Col align="left" span={12}>
                  <Form.Item
                    label="Birthday">
                    {getFieldDecorator('birthday', {
                      rules: [{ required: true, message: 'Please input your Birthday!' }],
                    })(
                      <Input
                        disabled={true}
                        placeholder="Birthday"
                        type="date"
                      />,
                    )}
                  </Form.Item>
                </Col>
                <Col align="left" span={24}>
                  <Form.Item
                    label="Address">
                    {getFieldDecorator('address', {
                      rules: [{ required: true, message: 'Please input your Address!' }],
                    })(
                      <Input.TextArea
                        disabled={true}
                        placeholder="Address"
                      />,
                    )}
                  </Form.Item>
                </Col>

                <Col align="left" span={12}>
                  <Form.Item
                    label="Nationality">
                    {getFieldDecorator('nationality', {
                      getValueFromEvent: onlyLetter,
                      rules: [{ required: true, message: 'Please input your Nationality!' },
                      { pattern: "^[A-Za-z]", message: "Please input valid Nationality" }],
                    })(
                      <Input
                        onDrop={cantDropAndPaste} onPaste={cantDropAndPaste}
                        placeholder="Nationality"
                      />,
                    )}
                  </Form.Item>
                </Col>

                <Col align="left" span={12}>
                  <Form.Item
                    label="Birth Place">
                    {getFieldDecorator('birthplace', {
                      getValueFromEvent: onlyLetter,
                      rules: [{ required: true, message: 'Please input your Birthday Place!' }],
                    })(
                      <Input
                        onDrop={cantDropAndPaste} onPaste={cantDropAndPaste}
                        placeholder="Birth Place"
                      />,
                    )}
                  </Form.Item>
                </Col>

                <Col align="left" span={12}>
                  <Form.Item
                    label="Nature of Work">
                    {getFieldDecorator('natureofwork', {
                      getValueFromEvent: onlyLetter,
                      rules: [{ required: true, message: 'Please input your Nature of Work!' },
                      { pattern: "^[A-Za-z]", message: "*Please input valid Nature of Work" }],
                    })(
                      <Input
                        onDrop={cantDropAndPaste} onPaste={cantDropAndPaste}
                        placeholder="Nature of Work"
                      />,
                    )}
                  </Form.Item>
                </Col>
                <Col align="left" span={12}>
                  <Form.Item
                    label="Source Of Fund">
                    {getFieldDecorator('sourceoffund', {
                      getValueFromEvent: onlyLetter,
                      rules: [{ required: true, message: 'Please input your Source Of Fund!' },
                      { pattern: "^[A-Za-z]", message: "*Please input valid Source of Fund" }],
                    })(
                      <Input
                        onDrop={cantDropAndPaste} onPaste={cantDropAndPaste}
                        placeholder="Source Of Fund"
                      />,
                    )}
                  </Form.Item>
                </Col>
              </Form>
            </Card>
          </Col>
          : null}
        <Col align="center" span={20}>
          <Card>
            <Col align="left" span={12}>
              <Button
                onClick={() => this.props.stepProceed(0)}>
                Back
              </Button>
            </Col>
            <Col align="right" span={12}>
              <Button
                disabled={!sender.hasOwnProperty('firstName')}
                onClick={this.proceed}
                type="primary"> Proceed </Button>
            </Col>
          </Card>
        </Col>
        <style jsx={true}>
          {`
            .has-error .ant-form-explain{
              color: #f5222d;
              font-size: 12px;
              font-style: italic;
            }

            .is-validating .ant-form-explain{
              color: #1890ff;
              font-size: 12px;
              font-style: italic;
            }

            .ant-form-item-label {
              line-height:1
            }
          `}
        </style>
      </Row>
    )
  }
}


const Sender = Form.create()(SenderDetails)

class SenderID extends React.Component {

  constructor() {
    super()
    this.state = {
      senderId: [],
      firstId: "",
      selectedId: {},
      firstIdData: {},
      firstIdType: "",
      secondId: {},
      secondIdData: {},
      modal: false,
      fileList: [],
      loading: false,
      uploadType: "ADD",
      validateStatus: "",
      help: ""
    }
  }

  proceed = (e) => {
    e.preventDefault()
    this.props.form.validateFields((err, values) => {
      if (!err) {
        this.props.stepProceed(3)
        this.props.getId(values)
      }
    });

  }

  componentDidMount() {
    this.getIdentification()
  }

  getIdentification = async () => {
    this.setState({ loading: true })
    const { sender } = this.props
    const body = new FormData()
    body.append('fname', sender.firstName)
    body.append('lname', sender.lastName)
    body.append('mname', sender.middleName)
    body.append('birthdate', sender.birthday)
    let res = await fetch('fetch_available_ids_post', {
      method: "POST",
      body
    })

    let result = await res.json()
    this.setState({ loading: false })
    if (!result.S) {
      return message.error(result.M)
    }
    this.setState({ senderId: result.T_DATA })
  }

  selectFirstID = async (e, opt) => {
    const { senderId } = this.state
    const { setFieldsValue } = this.props.form
    let firstIdData = {}
    let firstIdType = ""

    await senderId.map((i, ii) => {
      if (i.id === e) {
        firstIdData = i
        firstIdType = i.secbank_idtype
      }
    })
    // firstIdData.is_expired = "EXPIRED"
    if (firstIdData.is_expired !== "VALID") {
      let i = firstIdData
      let idtype = ""
      this.setState({ modal: true, uploadType: "UPDATE" }, () => {

        this.props.idType.map(ii => {
          if (i.description === ii.description) {
            idtype = ii.id
          }
        })
        
        setFieldsValue({
          newidtype: idtype,
          newidnumber: i.number,
          // newexpirydate: moment(i.expiry),
        })
      })
      return message.error("Please Update your ID")
    }

    this.setState({ firstIdData, firstIdType }, () => {
      let i = firstIdData
      setFieldsValue({
        firstIDType: i.description,
        firstIDNumber: i.number,
        firstIDExpiry: i.expiry,
        firstIDCreatedAt: i.created,
        secbankcode: i.secbank_code
      })
    })

    // console.log(firstIdData)
  }

  openImage = (i) => {
    window.open(i.attachment)
  }

  addId = () => {
    const { setFieldsValue } = this.props.form
    this.setState({ modal: true, uploadType: "ADD", fileList: [] })
    setFieldsValue({
      newidtype: "",
      newidnumber: "",
      newexpirydate: "",
    })
  }
  handleCancel = () => {
    this.setState({ modal: false, firstIdData: {}, firstID: "", firstIdType: "" })
  }

  handleOk = (e) => {
    const { fileList } = this.state
    e.preventDefault()
    this.setState({ validateStatus: "", help: "" })
    this.props.form.validateFields((err, values) => {
      if (!err) {
        this.uploadNewID(values)
      }
    });
  }

  selectIdAdd = (e, opt) => {
    // console.log(opt)
    this.setState({ selectedId: opt.props.datas })
  }

  uploadNewID = async (data) => {
    this.setState({ loading: true })

    const { sender } = this.props
    const body = new FormData()
    const { fileList } = this.state

    body.append('newidtype', data.newidtype)
    body.append('newidnumber', data.newidnumber)
    body.append('newexpirydate', moment(data.newexpirydate).format("YYYY-MM-DD"))
    body.append('file', fileList[0].originFileObj)
    body.append('create_new', this.state.uploadType)
    body.append('newidtype2', "")
    body.append('senderfname', sender.firstName)
    body.append('senderlname', sender.lastName)
    body.append('sendermname', sender.middleName)
    body.append('senderbdate', sender.birthday)
    body.append('type', "CASHCARD")

    // console.log(body)
    let res = await fetch('add_newid_secbank', {
      method: "POST",
      body
    })

    const result = await res.json()
    this.setState({ loading: false })
    if (!result.S) {
      return message.error(result.M)
    }

    if (result.S) {
      this.setState({ modal: false })
      return message.success(result.M)
    }



  }

  handleUpload = info => {
    // console.log(info.fileList)
    this.setState({ help: "", validateStatus: "" })
    let fileList = [{ ...info.fileList[info.fileList.length - 1] }];
    this.setState({ fileList }, () => {
      if (!["image/png", "image/jpg", "image/jpeg"].includes(fileList[0].type)) {
        this.setState({ validateStatus: "error", help: "Please select JPEG/JPG/PNG File type only" })
        return
      }
    })
    // console.log(info)
  }

  validate = (rule, value, callback) => {
    const { fileList } = this.state

    // console.log(fileList)
    if (!fileList.length) {
      return callback("Uploading of ID is required")
    } else if (!["image/png", "image/jpg", "image/jpeg"].includes(fileList[0].type)) {
      return callback("Please select JPEG/JPG/PNG File type only")
    } else {
      return callback()
    }

  }

  render() {
    const { getFieldDecorator, setFieldsValue } = this.props.form;
    const { senderId, firstIdData, firstIdType, secondIdData, modal, fileList, loading, uploadType, validateStatus, help, selectedId } = this.state
    const rule = selectedId ? selectedId.rule ? selectedId.rule.replace("/g", "").replace("/", "") : "" : "";

    let placeholder = selectedId.placeholder ? `ex. (${selectedId.placeholder})` : ""

    const props = {
      action: 'https://www.mocky.io/v2/5cc8019d300000980a055e76',
      onChange: this.handleUpload,
      multiple: false,
      fileList,
      accept: "image/png, image/jpeg, image/jpg"
    };

    return (
      <Row justify="center" type="flex">
        {modal ?
          <Modal
            visible={modal}
            style={{ width: 200 }}
            className="step4-modal"
            footer={null}
            closable={false}
            title="Add New ID"
          >
            <Spin spinning={loading}>
              <Form onSubmit={this.handleOk}>
                <Form.Item
                  label="ID TYPE">
                  {getFieldDecorator('newidtype', {
                    rules: [{ required: true, message: 'Please select your ID Type' }],
                  })(
                    <Select
                      placeholder="Select ID"
                      disabled={uploadType !== "ADD"}
                      onChange={this.selectIdAdd}
                    >
                      {this.props.idType.map(i => {
                        if (i.secbank_idtype === "PRIMARY") {
                          return (<Option key={i.id} datas={i} data={i.secbank_idtype} value={i.id}>{i.description}</Option>)
                        }
                      })}
                    </Select>
                  )}
                </Form.Item>
                <Form.Item
                  label={`ID NUMBER ${placeholder}`}>
                  {getFieldDecorator('newidnumber', {
                    getValueFromEvent: noBeginningSpace,
                    rules: [{ required: true, message: 'Please input your ID Number' },
                    {
                      pattern: new RegExp(rule, "g"),
                      message: `Invalid ${selectedId.description}`,
                    }],
                  })(
                    <Input
                      maxLength="15"
                      onDrop={cantDropAndPaste}
                      onPaste={cantDropAndPaste}
                      placeholder="ID Number" />
                  )}
                </Form.Item>
                <Form.Item
                  label="ID EXPIRY">
                  {getFieldDecorator('newexpirydate', {
                    rules: [{ required: true, message: 'Please input your Expiry' }],
                  })(
                    <Input readOnly className="inputExpiry" 
                          onChange={this.inputBdate}
                          ref={(e) => {
                            $(".inputExpiry").daterangepicker({
                              singleDatePicker: true,
                              showDropdowns: true,
                              locale: {
                                format: 'MM-DD-YYYY'
                              },
                              minDate: moment(),
                              maxDate:moment().add(20,"years")
                            })

                            $('.inputExpiry').on('apply.daterangepicker', (ev, picker) =>{
                              setFieldsValue({newexpirydate:picker.endDate.format('MM-DD-YYYY')})
                            });
                          }}
                          placeholder="ID Expiry (MM-DD-YYYY)" />
                  )}
                </Form.Item>
                <Form.Item
                  label="ID IMAGE">
                  {getFieldDecorator('file', {
                    validateTrigger: ["onChange", "onBlur"],
                    rules: [{ validator: this.validate }],
                  })(
                    <Upload {...props} fileList={this.state.fileList}>
                      <Button style={{ width: "470px" }} block type="dashed">
                        <Icon type="upload" /> Upload
                          </Button>
                    </Upload>
                  )}
                </Form.Item>

                <Row type="flex" justify="end" style={{ marginTop: 20 }}>
                  <Col span={12} align="right">
                    <Button
                      onClick={this.handleCancel}
                      disabled={false}
                      className='cancelBtn'>CANCEL</Button>
                  </Col>

                  <Col span={12} align="right">
                    <Button style={{ width: "70%" }}
                      className='proceedBtn'
                      htmlType="submit"
                      type="primary"
                      loading={false} >CONFIRM</Button>
                  </Col>
                </Row>
              </Form>
            </Spin>
          </Modal>
          : null}

        <Col span={20}>
          <Spin spinning={loading}>
            <Col span={24}>
              <Form >
                <Card>
                  <Button onClick={this.addId} icon="plus">Add New ID</Button>
                </Card>
                {modal ? null :
                  <Card
                    title="Select ID">
                    <Form.Item
                      label="ID Type">

                      <Input.Group compact>
                        {getFieldDecorator('firstID', {
                          rules: [{ required: true, message: 'Please select ID Type' }],
                        })(
                          <Select
                            style={{ width: "95%" }}
                            placeholder="Select ID Type"
                            onChange={this.selectFirstID}>
                            {senderId.map(i => {
                              if (i.secbank_idtype) {
                                return <Option value={i.id} key={i.id}>{i.description}</Option>
                              }
                            })}
                          </Select>
                        )}
                        <Button style={{ width: "5%" }} type="primary" title="refresh" onClick={this.getIdentification} icon="sync" />
                      </Input.Group>

                    </Form.Item>
                    {firstIdData.hasOwnProperty('number') ?
                      <Card
                        title={`${firstIdType} ID:`}>
                        <Form.Item
                          label="ID TYPE">
                          {getFieldDecorator('firstIDType', {
                            rules: [{ required: true, message: 'Please input ID Type' }],
                          })(
                            <Input disabled={true} placeholder="ID TYPE" />
                          )}
                        </Form.Item>
                        <Form.Item
                          label="ID NUMBER">
                          {getFieldDecorator('firstIDNumber', {
                            rules: [{ required: true, message: 'Please inputID Number' }],
                          })(
                            <Input disabled={true} placeholder="ID Number" />
                          )}
                        </Form.Item>
                        <Form.Item
                          label="ID EXPIRY">
                          {getFieldDecorator('firstIDExpiry', {
                            rules: [{ required: true, message: 'Please input your Expiry' }],
                          })(
                            <Input disabled={true} placeholder="ID Expiry" />
                          )}
                        </Form.Item>
                        <Form.Item
                          label="CREATED DATE">
                          {getFieldDecorator('firstIDCreatedAt', {
                            rules: [{ required: true, message: 'Please input your Created At' }],
                          })(
                            <Input disabled={true} placeholder="ID CreateAt" />
                          )}
                        </Form.Item>
                        {getFieldDecorator('secbankcode', {
                          rules: [{ required: true, message: 'Please input your Created At' }],
                        })(
                          <Input disabled={true} hidden placeholder="ID CreateAt" />
                        )}
                        <Form.Item
                          label="ID IMAGE">
                          <Button block onClick={() => this.openImage(firstIdData)} type="primary">View</Button>
                        </Form.Item>

                      </Card> : null}

                  </Card>}
              </Form>
            </Col>
          </Spin>
          <Col span={24}>
            <Card>
              <Col align="left" span={12}>
                <Button
                  onClick={() => this.props.stepProceed(1)}>
                  Back
                </Button>
              </Col>
              <Col align="right" span={12}>
                <Button
                  onClick={this.proceed}
                  type="primary"> Proceed </Button>
              </Col>
            </Card>
          </Col>
        </Col>
        <style jsx={true}>
          {`
          .ant-upload-list-item .anticon-close {
            display:none
          }
          .ant-upload-list-item-info .anticon-loading {
            display:none
          }
          .ant-progress-outer{
            display:none
          }
        `}
        </style>
      </Row>
    )
  }
}

const Identification = Form.create()(SenderID)

class BeneficiaryDetails extends React.Component {
  constructor() {
    super()
    this.state = {
      accntTable: [],
      beneficary: {},
      accountNumber: "",
      help: "",
      validateStatus: ""
    }
  }

  fetchAccountNo = async (search) => {
    const body = new FormData()
    body.append('inputSearch', search)
    // console.log(body)
    let res = await fetch('getCardlessAccountNo', {
      method: "POST",
      body
    })

    const result = await res.json()
    if (!result.S) {
      this.setState({ help: result.M, validateStatus: "error", accntTable: [] })
      return
    }
    this.setState({ help: "", validateStatus: "" })
    const accntTable = result.R_DATA
    this.setState({ accntTable })
  }

  searchAccountNumber = (e) => {
    const input = e.target.value
    var regexp = /[^0-9]*/g;
    this.setState({ accountNumber: input.replace(regexp, '') })
  }

  accntNoSearch = () => {
    const input = this.state.accountNumber
    if (!input) {
      this.setState({
        help: "Please enter an account number",
        validateStatus: "error"
      })
    } else if (input.length !== 13) {
      this.setState({
        help: `Required exact 13-digit account number (${(13-input.length)} Digits More)`,
        validateStatus: "error"
      })

    } else {
      this.setState({
        help: "Searching for available beneficiary",
        validateStatus: "validating"
      }, () => this.fetchAccountNo(input))
    }
  }

  getBeneficiary = async (beneficiary) => {
    const { setFieldsValue } = this.props.form
    const { FN, MN, LN, AN } = beneficiary
    await this.setState({ beneficiary })
    await setFieldsValue({
      firstName: FN,
      middleName: MN,
      lastName: LN,
      accountNumber: AN
    })
  }

  proceed = () => {
    this.props.form.validateFields((err, values) => {
      if (!err) {
        // console.log('Received values of form: ', values);
        this.props.getBeneficiaryDetails(values)
        this.props.stepProceed(4)
      }
    });
  };

  componentDidMount() {
    const { setFieldsValue } = this.props.form
    if (this.props.beneficiary.hasOwnProperty('accountNumber')) {
      setFieldsValue(this.props.beneficiary)
      this.fetchAccountNo(this.props.beneficiary.accountNumber)
      this.setState({
        accountNumber: this.props.beneficiary.accountNumber,
        beneficiary: this.props.beneficiary
      })
    }
  }

  render() {

    const columns = [
      {
        title: "First Name",
        key: 'FN',
        dataIndex: 'FN'
      },
      {
        title: "Middle Name",
        key: 'MN',
        dataIndex: 'MN'
      },
      {
        title: "Last Name",
        key: 'LN',
        dataIndex: 'LN'
      },
      {
        title: "Account Number",
        key: 'AN',
        dataIndex: 'AN'
      },
      {
        title: "Action",
        render: (text, beneficiary) =>
          <Button
            onClick={() => this.getBeneficiary(beneficiary)}
            type="primary">Select</Button>
      }
    ]

    const { accntTable, beneficiary, accountNumber, validateStatus, help } = this.state
    const { getFieldDecorator } = this.props.form
    return (
      <Row style={{ marginTop: 20 }} type="flex" justify="space-around" gutter={24}>
        <Col align="center" span={20}>
          <Spin spinning={(validateStatus === "validating")}>
            <Card title="Search Account Number">
              <Col span={8}>
                Search Account Number:
                    </Col>
              <Col span={16}>
                <Form.Item
                  validateStatus={validateStatus}
                  help={help}
                >
                  <Input.Search
                    maxLength="13"
                    value={accountNumber}
                    onChange={this.searchAccountNumber}
                    onSearch={this.accntNoSearch}
                    enterButton
                    onDrop={cantDropAndPaste}
                    onPaste={cantDropAndPaste}
                    placeholder="Search Account Number" />
                </Form.Item>
              </Col>
            </Card>
            {accntTable.length ?
              <Card title="Select Beneficiary">
                <Table columns={columns} dataSource={accntTable} />
              </Card> : null}
            {beneficiary ?
              <Form>
                <Card title="Beneficiary Details">
                  <Col align="left" span={12}>
                    <Form.Item
                      label="First Name">
                      {getFieldDecorator('firstName', {
                        rules: [{ required: true, message: 'Please input your First Name' }],
                      })(
                        <Input
                          disabled
                          placeholder="First Name"
                        />,
                      )}
                    </Form.Item>
                  </Col>
                  <Col align="left" span={12}>
                    <Form.Item
                      label="Middle Name">
                      {getFieldDecorator('middleName', {
                        rules: [{ required: true, message: 'Please input your Middle Name' }],
                      })(
                        <Input
                          disabled
                          placeholder="Middle Name"
                        />,
                      )}
                    </Form.Item>
                  </Col>

                  <Col align="left" span={12}>
                    <Form.Item
                      label="Last Name">
                      {getFieldDecorator('lastName', {
                        rules: [{ required: true, message: 'Please input your Last Name' }],
                      })(
                        <Input
                          disabled
                          placeholder="Last Name"
                        />,
                      )}
                    </Form.Item>
                  </Col>
                  <Col align="left" span={12}>
                    <Form.Item
                      label="Account Number">
                      {getFieldDecorator('accountNumber', {
                        rules: [{ required: true, message: 'Please input your Account Number' }],
                      })(
                        <Input
                          disabled
                          placeholder="Middle Name"
                        />,
                      )}
                    </Form.Item>
                  </Col>
                </Card>
              </Form> : null
            }
          </Spin>
        </Col>
        <Col align="center" span={20}>
          <Card>
            <Col align="left" span={12}>
              <Button
                onClick={() => this.props.stepProceed(2)}>
                Back
                  </Button>
            </Col>
            <Col align="right" span={12}>
              <Button
                disabled={!beneficiary}
                onClick={this.proceed}
                type="primary"> Proceed </Button>
            </Col>
          </Card>
        </Col>
      </Row>
    )
  }
}

const Beneficiary = Form.create()(BeneficiaryDetails)

class Summary extends React.Component {
  constructor() {
    super()
    this.state = {
      loading: false,
      visible: false,
      validateStatus: "",
      help: "",
      otp:false,
      otpData:{}
    }
  }

  proceed = () => {
    this.setState({ visible: true })
  }

  onClickProceed = () => {
    this.props.form.validateFields(['password'], (err, values) => {
      if (!err) {

        this.setState({ validateStatus: "", help: "" })
        this.confirmCashCard(values)
      }

      if (err) {
        this.setState({
          validateStatus: "error",
          help: err.password.errors[0].message
        })
      }


    });

  }

  unholdCashCard = async (values) => {
    try {
      this.setState({ validateStatus: "validating", help: "Please wait for a while" })
      const { sender, beneficiary, amount, id } = this.props
      const {otpData} = this.state

      const body = new FormData()
      body.append('accntNo', beneficiary.accountNumber)
      body.append('amount', amount)
      body.append('senderFirstName', sender.firstName)
      body.append('senderMidName', sender.middleName)
      body.append('senderLastName', sender.lastName)
      body.append('senderAddressLine1', sender.address)
      body.append('senderBirthdate', sender.birthday)
      body.append('senderContactDetails', sender.birthplace)
      body.append('senderBirthPlace', sender.birthplace)
      body.append('senderNationality', sender.nationality)
      body.append('senderSourceOfFunds', sender.sourceoffund)
      body.append('senderNatureOfWork', sender.natureofwork)
      body.append('primaryIDType', id.secbankcode)
      body.append('primaryIDNo', id.firstIDNumber)
      body.append('recipientFirstName', beneficiary.firstName)
      body.append('recipientMidName', beneficiary.middleName)
      body.append('recipientLastName', beneficiary.lastName)
      body.append('transpass', values.password)
      body.append('otptrackno', otpData.TN)
      body.append('vcode', values.vcode)

      let res = await fetch('cashcard_unhold_new', {
        method: "POST",
        body
      })

      let result = await res.json()
      if (result.S == 0) {
      
        this.setState({
          validateStatus: "error",
          help: result.M,
          visible: false, otp: false
        }, () => {
          const {M, A} = result
            const msg = A && A.hasOwnProperty("C") ? A.C: ""  
          Modal.error({
            title: "Ecash Cashcard",
            content: (<>{this.messageChanger(M, msg)} <br /> The system will reload</>),
            onOk: () => { location.reload() }
          })
        })
        return;
      }
      this.props.getSummaryDetails(result)
      this.props.stepProceed(5)


    } catch (error) {
      // console.log(error) 
      this.setState({ validateStatus: "error", help: "Please try Again" })
    }
  }

  confirmCashCard = async (values) => {
    try {
      this.setState({ validateStatus: "validating", help: "Please wait for a while" })
      const { sender, beneficiary, idType, amount, id } = this.props

      const body = new FormData()
      body.append('accntNo', beneficiary.accountNumber)
      body.append('amount', amount)
      body.append('senderFirstName', sender.firstName)
      body.append('senderMidName', sender.middleName)
      body.append('senderLastName', sender.lastName)
      body.append('senderAddressLine1', sender.address)
      body.append('senderBirthdate', sender.birthday)
      body.append('senderContactDetails', sender.birthplace)
      body.append('senderBirthPlace', sender.birthplace)
      body.append('senderNationality', sender.nationality)
      body.append('senderSourceOfFunds', sender.sourceoffund)
      body.append('senderNatureOfWork', sender.natureofwork)
      body.append('primaryIDType', id.secbankcode)
      body.append('primaryIDNo', id.firstIDNumber)
      body.append('recipientFirstName', beneficiary.firstName)
      body.append('recipientMidName', beneficiary.middleName)
      body.append('recipientLastName', beneficiary.lastName)
      body.append('transpass', values.password)

      let res = await fetch('cashcard_confirm_new', {
        method: "POST",
        body
      })

      let result = await res.json()
      if (!result.S) {
        const {A, M} = result
         const msg = A && A.hasOwnProperty("C") ? A.C: "" 
        this.setState({
          validateStatus: "error",
          help: this.messageChanger(M, msg)
        })
        return;
      }

      if (result.S == 2) {
        this.setState({
          visible: false,
          otp: true,
          otpData: result,
          validateStatus: "", help: ""
        })
        return;
      }

      await this.props.getSummaryDetails(result)
      await this.props.stepProceed(5)

    } catch (error) {
      console.log(error);
      this.setState({
        validateStatus: "",
        help: "Error Occured Please Try Again"
      })
    }

  }

  messageChanger = (msg, code = "") => {
      switch (msg) {
        case "Invalid username or password":
          return `There is an error occured please contact our technical support errCode:[${code}]`
        default:
          return msg;
      }
  }



  handleCancel = () => {
    this.setState({ visible: false, otp: false })
  }

  onClickOTP = () => {
    this.props.form.validateFields(['vcode'], (err, values) => {
      // console.log(err, values)
      if (!err) {
        this.setState({ validateStatus: "", help: "" })
        this.unholdCashCard(values)
      }

      if (err) {
        this.setState({
          validateStatus: "error",
          help: err.vcode.errors[0].message
        })
      }


    });
  }

  render() {

    const { sender, beneficiary, idType, amount, id} = this.props
    const { getFieldDecorator, getFieldValue } = this.props.form;
    const { visible, loading, validateStatus, help, otp, otpData  } = this.state

    return (
      <Row style={{ marginTop: 20 }} type="flex" justify="space-around" gutter={24}>
        <Col align="center" span={18}>
        <Modal
            visible={otp}
            closable={false}
            footer={null}
            style={{ width: 200 }}
            className="step4-modal"
            maskClosable={false}
          >
            <Form>
              <Row type="flex" justify="center" align="middle">
                <Col span={24}>
                  <span className="span-pass"
                    style={{ fontSize: 20, fontWeight: 400 }}>
                    One Time Password</span><br />
                  <span style={{ fontSize: 12 }}>
                    {otpData.M}<br />
                    Tracking Number: {otpData.TN}</span>
                </Col>
              </Row>
              <Row type="flex" justify="center" align="middle" style={{ marginTop: 20 }}>
                <Col span={18}>

                  <Form.Item
                    help={help}
                    validating
                    validateStatus={validateStatus}
                    colon={false}
                    style={{ width: "100%" }}
                    className="incorrect-password"
                  >
                    {getFieldDecorator("vcode", {
                      rules:
                        [{
                          required: true,
                          message: "One Time Password is required"
                        }],
                    })(
                      <Input
                        style={{ width: "100%" }}
                        type="password"
                        readOnly={(validateStatus === "validating")}
                        placeholder="Enter your password" />
                    )}
                  </Form.Item>
                </Col>
              </Row>


              <Row type="flex" justify="end" style={{ marginTop: 20 }}>
                <Col span={9} offset={1} align="right">
                  <Button style={{ width: "70%" }}
                    onClick={this.handleCancel}
                    disabled={(validateStatus === "validating")}
                    className='cancelBtn'>CANCEL</Button>
                </Col>

                <Col span={9} align="left">
                  <Button style={{ width: "70%" }}
                    className='proceedBtn'
                    onClick={this.onClickOTP}
                    loading={(validateStatus === "validating")} >CONFIRM</Button>
                </Col>
              </Row>
            </Form>
          </Modal>
          <Modal
            visible={visible}
            closable={false}
            footer={null}
            style={{ width: 200 }}
            className="step4-modal"
            maskClosable={false}
          >
            <Form>
              <Row type="flex" justify="center" align="middle">
                <Col span={24}>
                  <span className="span-pass"
                    style={{ fontSize: 20, fontWeight: 400 }}>
                    Transaction Password</span><br />
                  <span style={{ fontSize: 12 }}>
                    Please enter your transaction password
														below to submit transaction.</span>
                </Col>
              </Row>
              <Row type="flex" justify="center" align="middle" style={{ marginTop: 20 }}>
                <Col span={18}>

                  <Form.Item
                    help={help}
                    validating
                    validateStatus={validateStatus}
                    colon={false}
                    style={{ width: "100%" }}
                    className="incorrect-password"
                  >
                    {getFieldDecorator("password", {
                      rules:
                        [{
                          required: true,
                          message: "Transaction password is required"
                        }],
                    })(
                      <Input
                        style={{ width: "100%" }}
                        type="password"
                        readOnly={(validateStatus === "validating")}
                        placeholder="Enter your password" />
                    )}
                  </Form.Item>
                </Col>
              </Row>


              <Row type="flex" justify="end" style={{ marginTop: 20 }}>
                <Col span={9} offset={1} align="right">
                  <Button style={{ width: "70%" }}
                    onClick={this.handleCancel}
                    disabled={(validateStatus === "validating")}
                    className='cancelBtn'>CANCEL</Button>
                </Col>

                <Col span={9} align="left">
                  <Button style={{ width: "70%" }}
                    className='proceedBtn'
                    onClick={this.onClickProceed}
                    loading={(validateStatus === "validating")} >CONFIRM</Button>
                </Col>
              </Row>
            </Form>
          </Modal>
          <Card
            title="Summary Details">
            <Divider>Sender Details</Divider>
            <Row type="flex" justify="space-around">

              <Col align="left" span={12}>
                First Name:
                      </Col>
              <Col align="right" span={12}>
                {sender.firstName}
              </Col>

              <Col align="left" span={12}>
                Middle Name:
                      </Col>
              <Col align="right" span={12}>
                {sender.middleName}
              </Col>

              <Col align="left" span={12}>
                Last Name:
                      </Col>
              <Col align="right" span={12}>
                {sender.lastName}
              </Col>

              <Col align="left" span={12}>
                Address:
                      </Col>
              <Col align="right" span={12}>
                {sender.address}
              </Col>

              <Col align="left" span={12}>
                Nationality:
                      </Col>
              <Col align="right" span={12}>
                {sender.nationality}
              </Col>

              <Col align="left" span={12}>
                Birthplace:
                      </Col>
              <Col align="right" span={12}>
                {sender.birthplace}
              </Col>

              <Col align="left" span={12}>
                Nature of Work:
                      </Col>
              <Col align="right" span={12}>
                {sender.natureofwork}
              </Col>

              <Col align="left" span={12}>
                Source of Fund:
                      </Col>
              <Col align="right" span={12}>
                {sender.sourceoffund}
              </Col>

            </Row>

            <Divider>ID Details</Divider>
            <Row type="flex" justify="space-around">
              <Col align="left" span={12}>
                {id.firstIDType}
              </Col>
              <Col align="right" span={12}>
                {id.firstIDNumber}
              </Col>
            </Row>
            <Divider>Beneficiary Details</Divider>
            <Row type="flex" justify="space-around">

              <Col align="left" span={12}>
                First Name:
                      </Col>
              <Col align="right" span={12}>
                {beneficiary.firstName}
              </Col>

              <Col align="left" span={12}>
                Middle Name:
                      </Col>
              <Col align="right" span={12}>
                {beneficiary.middleName}
              </Col>

              <Col align="left" span={12}>
                Last Name:
                      </Col>
              <Col align="right" span={12}>
                {beneficiary.lastName}
              </Col>

              <Col align="left" span={12}>
                Account Number:
                      </Col>
              <Col align="right" span={12}>
                {beneficiary.accountNumber}
              </Col>

            </Row>
            <Divider>Transaction Details</Divider>
            <Row>
              <Col align="left" span={12}>
                Transaction Type:
                      </Col>
              <Col align="right" span={12}>
                Ecash Cashcard
                      </Col>

              <Col align="left" span={12}>
                Amount
                      </Col>
              <Col align="right" span={12}>
                {numeral(parseInt(amount)).format("0,00.00")}
              </Col>
              <Col align="left" span={12}>
                Charge
              </Col>
              <Col align="right" span={12}>
                {numeral(60).format("0,00.00")}
              </Col>
              <Col align="left" span={12}>
                Total Amount
              </Col>
              <Col align="right" span={12}>
                {numeral(parseInt(amount) + 60).format("0,00.00")}
              </Col>
            </Row>
          </Card>
          <Card>
            <Col span={12}>
              <Button onClick={() => this.props.stepProceed(3)}>
                Back
                        </Button>
            </Col>
            <Col span={12}>
              <Button onClick={this.proceed}>
                Transact
              </Button>
            </Col>
          </Card>
        </Col>
        <style jsx="true">{`  
                  .incorrect-password  {
                        font-size: 12px;
                      }

                    .ant-form-explain .has-error{
                        color: #f5222d;
                        font-style: italic;
                    }

                    .ant-form-explain .is-validating{
                        color: #f6c933;
                        font-style: italic;
                    }

                    .span-pass{
                      color:#f6c933; 
                    }

                    .ant-input:focus { 
                      box-shadow: 0 0 0 transparent;
                      border-radius: 0;
                    }

                    .ant-input {
                      border: 0;
                      border-bottom: 1px solid #8a9199;
                      border-radius: 0;
                      background: transparent;
                    }

                    .proceedBtn{
                      color: #f6c933;
                      background-color: #fff ;
                      border-radius: 4px;
                      border: 0 !important;
                      box-shadow: 0 0 0 transparent;
                      height:30px;
                      font-size:15px;
                      text-align: center;
                    }

                    .cancelBtn{
                      background-color: #fff ;
                      border-radius: 4px;
                      border: 0 !important;
                      box-shadow: 0 0 0 transparent;
                      height:30px;
                      font-size:15px;
                      text-align: center;
                    }

                    .ant-modal-content {
                      width: 400px;
                      margin: 0 auto;
                      padding: 10px;
                    }

                    .ant-modal-body {
                      font-size: 14px;
                      line-height: 1.5;
                      word-wrap: break-word;
                  }`}
        </style>
      </Row>
    )
  }
}

const SummaryDetails = Form.create()(Summary)

class Success extends React.Component {
  componentDidMount() {
    let { EC } = this.props.summaryDetails
    const ecEmelent = document.getElementById('spanEC')
    ecEmelent.innerHTML = EC
  }
  render() {
    const { beneficiary, sender, amount, summaryDetails } = this.props
    return (
      <Row
        key="a"
        className="step5-main"
        style={{ marginTop: 10 }}
        type="flex"
        justify="space-around"
        align="middle">
        <Col span={14} className="step5-col">
          <Row >
            <Card
              style={{ marginTop: 30 }}>
              <Col align="center">
                <Col>
                  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Eo_circle_yellow_checkmark.svg/512px-Eo_circle_yellow_checkmark.svg.png" alt=""
                    style={{ width: "80px", height: "90px", paddingBottom: "10px" }} />
                </Col>

                <Col>
                  <span
                    style={{ fontWeight: 500, fontSize: 20 }}>
                    Waiting for Transaction Approval</span>
                </Col>
                <Col>
                  <span
                    style={{ fontWeight: 500, fontSize: 18 }}>
                    {summaryDetails.M}</span>
                </Col>

                <Row style={{ marginTop: 40 }}>
                  <Col span={8} align="left">
                    <span style={{ fontWeight: 400, fontSize: 16 }} >Tracking Number:</span>
                  </Col>
                  <Col span={16} align="right" style={{ fontWeight: 400, fontSize: 16 }}>
                    <span>{summaryDetails.TN}</span>
                  </Col>
                </Row>

                <Row>
                  <Col span={8} align="left">
                    <span style={{ fontWeight: 400, fontSize: 16 }} >Transaction Type:</span>
                  </Col>
                  <Col span={16} align="right" style={{ fontWeight: 400, fontSize: 16 }}>
                    <span ><span >Ecash to CashCard</span></span>
                  </Col>
                </Row>
                <Row>
                  <Col span={8} align="left">
                    <span style={{ fontWeight: 400, fontSize: 16 }} >Sender Full Name:</span>
                  </Col>
                  <Col span={16} align="right" style={{ fontWeight: 400, fontSize: 16 }}>
                    <span >{`${sender.firstName} ${sender.lastName}`}</span>
                  </Col>
                </Row>
                <Row>
                  <Col span={8} align="left">
                    <span style={{ fontWeight: 400, fontSize: 16 }} >Beneficiary Full Name:</span>
                  </Col>
                  <Col span={16} align="right" style={{ fontWeight: 400, fontSize: 16 }}>
                    <span >{`${beneficiary.firstName} ${beneficiary.lastName}`}</span>
                  </Col>
                </Row>
              </Col>

              <Divider dashed style={{ marginBottom: 20 }} />

              <Row>
                <Col span={12} align="left">
                  <span style={{ fontWeight: 600, fontSize: 16 }} >Transaction Amount:</span>
                </Col>
                <Col span={12} align="right" style={{ fontWeight: 600, fontSize: 18 }}>
                  <span>PHP </span> {numeral(parseInt(amount)).format("0,00.00")}
                </Col>
              </Row>
              <Row
                key="a"
                type="flex"
                justify="center"
                align="middle"
                style={{ marginTop: 30 }}>
                {/* <Col style={{ marginBottom: 10 }} span={18} align="center">
                  <a href={summaryDetails.URL} target="_blank" rel="noopener noreferrer">
                    <Icon style={{ fontSize: 20 }} type="file-pdf" /><br />
                    <span style={{ fontSize: 12 }}>Download a copy of your receipt</span>
                  </a>
                </Col> */}

                <Col style={{ marginBottom: 40 }} span={18} align="center">
                  <Button
                    style={{ width: "100%" }}
                    block className='proceedBtn'
                    onClick={() => this.props.done()}>Done</Button>
                </Col>
              </Row>
            </Card>
          </Row>
        </Col>
      </Row>
    )
  }
}

const SuccessTransaction = Form.create()(Success)

function App() {
  return (
    <div>
      <CashCard />
    </div>
  )
}

ReactDOM.render(
  <App />,
  rootElement
)
