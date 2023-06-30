waitingDialog.show('Please wait..', { dialogSize: 'sm', progressType: 'primary' });
window.scrollTo(0, 0)
const rootElement = document.getElementById('root')
const { Upload, Icon, Divider, Card, Steps, Button, Row, Col, Alert, Tag, Input, Table, Form, DatePicker, Modal, Select, message, Spin, Tabs, Popover } = window.antd
const numeral = window.numeral
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
      summaryDetails:{}
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

  stepProceed = (current) => {
    this.setState({ current })
  }

  getTrNumber = (trNumber) => {
    this.setState({ trNumber })
  }

  getAmount = (amount) => {
    this.setState({ amount })
  }

  getsummaryDetails = (summaryDetails) => {
    this.setState({ summaryDetails })
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
          idType={idType}
          sender={sender}
          getSenderDetails={this.getSenderDetails}
        />
      case 2:
        return <Beneficiary
          stepProceed={this.stepProceed}
          beneficiary={beneficiary}
          getBeneficiaryDetails={this.getBeneficiaryDetails}
        />
      case 3:
        return <SummaryDetails
          idType={idType}
          id={id}
          sender={sender}
          beneficiary={beneficiary}
          getTrNumber={this.getTrNumber}
          stepProceed={this.stepProceed}
          amount={amount}
          getsummaryDetails={this.getsummaryDetails}
        />
      case 4:
        return <SuccessTransaction
          stepProceed={this.stepProceed}
          idType={idType}
          sender={sender}
          beneficiary={beneficiary}
          trNumber={trNumber}
          done={this.done}
          summaryDetails={summaryDetails}
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
        if ((amount % 100) !== 0) {
          this.setState({
            help: "Amount must be multiple by 100",
            status: "error"
          })
        }
        else if (amount < 500) {
          this.setState({
            help: "Minimum amount of 500",
            status: "error"
          })
          return
        } else if (amount > 10000) {
          this.setState({
            help: "Maximum amount of 10,000",
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
    const { getFieldDecorator } = this.props.form;
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
                        onPressEnter={this.getAmount}
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
  }

  proceed = () => {
    this.props.form.validateFields((err, values) => {
      if (!err) {
        console.log('Received values of form: ', values, JSON.stringify(values));
        this.props.getSenderDetails({
          ...values,
          middleName:values.middleName ? values.middleName : " "
        })
        this.props.stepProceed(2)
      }
    });
  };

  componentDidMount() {
    const { setFieldsValue } = this.props.form
    if (this.props.sender) {
      setFieldsValue(this.props.sender)
    }
  }

  validate = (rule, value, callback) => {
    let today = moment().subtract(12, "years").valueOf()

    let value2 = new Date(value);
    value2 = value2.setHours(0, 0, 0, 0);

    let value3 = new Date("1900-12-31");
    value3 = value3.setHours(0, 0, 0, 0);

    console.log(value2, today, value3)
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

  render() {
    const { idType, sender} = this.props
    const { birthday } = sender
    const { getFieldDecorator, setFieldsValue } = this.props.form;
    return (
      <Row style={{ marginTop: 20 }} type="flex" justify="space-around" gutter={24}>
        <Col align="center" span={20}>
          <Card
            title="Sender Details">
            <Form>
              <Col align="left" span={12}>
                <Form.Item
                  label="First Name:">
                  {getFieldDecorator('firstName', {
                    getValueFromEvent: onlyLetter,
                    rules: [{ required: true, message: 'Please input First Name!' },
                    { pattern: "^[A-Za-z]", message: "*Please input valid First Name" }],
                  })(
                    <Input
                      placeholder="First Name"
                      onDrop={cantDropAndPaste}
                      onPaste={cantDropAndPaste}
                    />,
                  )}
                </Form.Item>
              </Col>
              <Col align="left" span={12}>
                <Form.Item
                  label="Middle Name:">
                  {getFieldDecorator('middleName', {
                    getValueFromEvent: onlyLetter,
                    rules: [{ required: false, message: 'Please input Middle Name!' },
                    { pattern: "^[A-Za-z]", message: "*Please input valid Middle Name" }],
                  })(
                    <Input
                      placeholder="Middle Name"
                      onDrop={cantDropAndPaste}
                      onPaste={cantDropAndPaste}
                    />,
                  )}
                </Form.Item>
              </Col>
              <Col align="left" span={12}>
                <Form.Item
                  label="Last Name:">
                  {getFieldDecorator('lastName', {
                    getValueFromEvent: onlyLetter,
                    rules: [{ required: true, message: 'Please input Last Name!' },
                    { pattern: "^[A-Za-z]", message: "*Please input valid Last Name" }],
                  })(
                    <Input
                      placeholder="Last Name"
                      onDrop={cantDropAndPaste}
                      onPaste={cantDropAndPaste}
                    />,
                  )}
                </Form.Item>
              </Col>
              <Col align="left" span={12}>
                <Form.Item
                  label="Birthday">
                  {getFieldDecorator('birthday', {
                    rules: [{ validator: this.validate }],
                  })(
                    <Input readOnly className="senderBdate"
                      ref={(e) => {
                        $(".senderBdate").daterangepicker({
                          singleDatePicker: true,
                          showDropdowns: true,
                          autoUpdateInput: false,
                          locale: {
                            format: 'MM-DD-YYYY'
                          },
                          minDate: moment().subtract(100, 'year'),
                          maxDate: moment().subtract(12, 'year'),
                        })

                        $('.senderBdate').on('apply.daterangepicker', (ev, picker) => {
                          console.log(picker)
                          setFieldsValue({ birthday: picker.endDate.format('MM-DD-YYYY') })
                        });
                      }}
                      placeholder="Birthdate (MM-DD-YYYY)" />
                  )}
                </Form.Item>
              </Col>
              <Col align="left" span={24}>
                <Form.Item
                  label="Address">
                  {getFieldDecorator('address', {
                    getValueFromEvent: noBeginningSpace,
                    rules: [{ required: true, message: 'Please input your Address' },
                    { max: 50, message: 'Not Greater than 50 Characters' }],
                  })(
                    <Input.TextArea
                      onDrop={cantDropAndPaste}
                      onPaste={cantDropAndPaste}
                      placeholder="Address"
                    />,
                  )}
                </Form.Item>
              </Col>

              <Col align="left" span={12}>
                <Form.Item
                  label="Mobile Number">
                  {getFieldDecorator('mobileNumber', {
                    getValueFromEvent: onlyNumber,
                    rules: [{ required: true, message: 'Please input Mobile Number!' },
                    { min: 11, message: 'Mobile Number Must be 11 Digits' },
                    { max: 11, message: 'Mobile Number Must be 11 Digits' }],
                  })(
                    <Input
                      maxLength="11"
                      onKeyPress={onlyNumber}
                      placeholder="Mobile Number"
                    />,
                  )}
                </Form.Item>
              </Col>

              <Col align="left" span={12}>
                <Form.Item
                  label="Email Address">
                  {getFieldDecorator('emailAddress', {
                    getValueFromEvent: noBeginningSpace,
                    rules: [{ required: true, message: 'Please input Email Address!' },
                    { type: "email", message: 'Invalid Email Address' }],
                  })(
                    <Input
                      onDrop={cantDropAndPaste}
                      onPaste={cantDropAndPaste}
                      placeholder="Email Address"
                    />,
                  )}
                </Form.Item>
              </Col>

              <Col align="left" span={24}>
                <Form.Item
                  label="Purpose of Remittance">
                  {getFieldDecorator('purposeofremittance', {
                    getValueFromEvent: onlyLetter,
                    rules: [{ required: true, message: 'Please input Purpose of Remittance' }],
                  })(
                    <Input.TextArea
                      onDrop={cantDropAndPaste}
                      onPaste={cantDropAndPaste}
                      placeholder="Nature of Work"
                    />,
                  )}
                </Form.Item>
              </Col>

              <Col align="left" span={12}>
                <Form.Item
                  label="ID Type">
                  {getFieldDecorator('idType', {
                    rules: [{ required: true, message: 'Please input ID Type' }],
                  })(
                    <Select>
                      {idType ? idType.map(i => <Option value={i.description}>{i.description}</Option>) : null}
                    </Select>,
                  )}
                </Form.Item>
              </Col>

              <Col align="left" span={12}>
                <Form.Item
                  label="ID Number">
                  {getFieldDecorator('idNumber', {
                    getValueFromEvent: noBeginningSpace,
                    rules: [{ required: true, message: 'Please input ID Number' }],
                  })(
                    <Input
                      placeholder="ID Number"
                    />,
                  )}
                </Form.Item>
              </Col>
            </Form>
          </Card>
        </Col>

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
          `}
        </style>
      </Row>
    )
  }
}

const Sender = Form.create()(SenderDetails)


class BeneficiaryDetails extends React.Component {
  constructor() {
    super()
    this.state = {
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
        console.log('Received values of form: ', values, JSON.stringify(values));
        this.props.getBeneficiaryDetails({
          ...values,
          middleName:values.middleName ? values.middleName : " "
        })
        this.props.stepProceed(3)
      }
    });
  };

  componentDidMount() {
    const { setFieldsValue } = this.props.form
    if (this.props.beneficiary) {
      setFieldsValue(this.props.beneficiary)
    }
  }

  validate = (rule, value, callback) => {
    let today = moment().subtract(12, "years").valueOf()

    let value2 = new Date(value);
    value2 = value2.setHours(0, 0, 0, 0);

    let value3 = new Date("1900-12-31");
    value3 = value3.setHours(0, 0, 0, 0);

    console.log(value2, today, value3)
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

  render() {
    const { getFieldDecorator, setFieldsValue, getFieldValue } = this.props.form;
    const { beneficiary } = this.props
    return (
      <Row style={{ marginTop: 20 }} type="flex" justify="space-around" gutter={24}>
        <Col align="center" span={20}>
          <Card
            title="Beneficiary Details">
            <Form>
              <Col align="left" span={12}>
                <Form.Item
                  label="First Name:">
                  {getFieldDecorator('firstName', {
                    getValueFromEvent: onlyLetter,
                    rules: [{ required: true, message: 'Please input First Name!' }],
                  })(
                    <Input
                      onDrop={cantDropAndPaste}
                      onPaste={cantDropAndPaste}
                      placeholder="First Name"
                    />,
                  )}
                </Form.Item>
              </Col>
              <Col align="left" span={12}>
                <Form.Item
                  label="Middle Name:">
                  {getFieldDecorator('middleName', {
                    getValueFromEvent: onlyLetter,
                    rules: [{ required: false, message: 'Please input Middle Name!' }],
                  })(
                    <Input
                      onDrop={cantDropAndPaste}
                      onPaste={cantDropAndPaste}
                      placeholder="Middle Name"
                    />,
                  )}
                </Form.Item>
              </Col>
              <Col align="left" span={12}>
                <Form.Item
                  label="Last Name:">
                  {getFieldDecorator('lastName', {
                    getValueFromEvent: onlyLetter,
                    rules: [{ required: true, message: 'Please input Last Name!' }],
                  })(
                    <Input
                      onDrop={cantDropAndPaste}
                      onPaste={cantDropAndPaste}
                      placeholder="Last Name"
                    />,
                  )}
                </Form.Item>
              </Col>
              <Col align="left" span={12}>
                <Form.Item
                  label="Birthday">
                  {getFieldDecorator('birthday', {
                    rules: [{ validator: this.validate }],
                  })(
                    <Input readOnly className="beneBdate"
                      ref={(e) => {
                        $(".beneBdate").daterangepicker({
                          singleDatePicker: true,
                          showDropdowns: true,
                          autoUpdateInput: false,
                          locale: {
                            format: 'MM-DD-YYYY'
                          },
                          minDate: moment().subtract(100, 'year'),
                          maxDate: moment().subtract(12, 'year'),
                        })

                        $('.beneBdate').on('apply.daterangepicker', (ev, picker) => {
                          setFieldsValue({ birthday: picker.endDate.format('MM-DD-YYYY') })
                        });
                      }}
                      placeholder="Birthdate (MM-DD-YYYY)" />
                  )}
                </Form.Item>
              </Col>
              <Col align="left" span={24}>
                <Form.Item
                  label="Address">
                  {getFieldDecorator('address', {
                    getValueFromEvent: noBeginningSpace,
                    rules: [{ required: true, message: 'Please input Address!' }],
                  })(
                    <Input.TextArea
                      onDrop={cantDropAndPaste}
                      onPaste={cantDropAndPaste}
                      placeholder="Address"
                    />,
                  )}
                </Form.Item>
              </Col>

              <Col align="left" span={12}>
                <Form.Item
                  label="Mobile Number">
                  {getFieldDecorator('mobileNumber', {
                    getValueFromEvent: onlyNumber,
                    rules: [{ required: true, message: 'Please input Mobile Number!' },
                    { min: 11, message: 'Mobile Number Must be 11 Digits' },
                    { max: 11, message: 'Mobile Number Must be 11 Digits' }],
                  })(
                    <Input
                      onKeyPress={onlyNumber}
                      onDrop={cantDropAndPaste}
                      onPaste={cantDropAndPaste}
                      maxLength="11"
                      placeholder="Mobile Number"
                    />,
                  )}
                </Form.Item>
              </Col>

              <Col align="left" span={12}>
                <Form.Item
                  label="Email Address">
                  {getFieldDecorator('emailAddress', {
                    getValueFromEvent: noBeginningSpace,
                    rules: [{ required: true, message: 'Please input Email Address!' },
                    { type: "email", message: 'Invalid Email Address' }],
                  })(
                    <Input
                      onDrop={cantDropAndPaste}
                      onPaste={cantDropAndPaste}
                      placeholder="Email Address"
                    />,
                  )}
                </Form.Item>
              </Col>
            </Form>
          </Card>
        </Col>

        <Col align="center" span={20}>
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
          `}
        </style>
      </Row>
    )
  }
}

const Beneficiary = Form.create()(BeneficiaryDetails)

class Summary extends React.Component {
  constructor() {
    super()
    this.state = {
      otp: false,
      loading: false,
      visible: false,
      validateStatus: "",
      help: "",
      otpData: {}
    }
  }

  proceed = () => {
    this.setState({ visible: true })
  }

  onClickProceed = () => {
    this.props.form.validateFields(['password'], (err, values) => {
      if (!err) {

        this.setState({ validateStatus: "", help: "" })
        this.confirmCardless(values)
      }

      if (err) {
        this.setState({
          validateStatus: "error",
          help: err.password.errors[0].message
        })
      }


    });

  }

  onClickOTP = () => {
    this.props.form.validateFields(['vcode'], (err, values) => {
      if (!err) {

        this.setState({ validateStatus: "", help: "" })
        this.unholdCardlessPadala(values)
      }

      if (err) {
        this.setState({
          validateStatus: "error",
          help: err.vcode.errors[0].message
        })
      }


    });
  }

  unholdCardlessPadala = async (values) => {
    try {
      const { otpData } = this.state
      this.setState({ validateStatus: "validating", help: "Please wait for a while" })
      const body = new FormData()
      body.append('trackno', otpData.TN)
      body.append('vcode', values.vcode)

      let res = await fetch('unholdCardlessPadala', {
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
          Modal.error({
            title: "Ecash Cardless Padala",
            content: (<>{result.M} <br /> The system will reload</>),
            onOk: () => { location.reload() }
          })
        })
        return;
      }
      this.props.getsummaryDetails(result)
      this.props.stepProceed(4)


    } catch (error) {

    }
  }

  confirmCardless = async (values) => {
    try {
      this.setState({ validateStatus: "validating", help: "Please wait for a while" })
      const { sender, beneficiary, idType, amount, id } = this.props

      const body = new FormData()

      body.append('b_fname', beneficiary.firstName)
      body.append('b_mname', beneficiary.middleName)
      body.append('b_lname', beneficiary.lastName)
      body.append('b_bdate', beneficiary.birthday)
      body.append('b_mobile', beneficiary.mobileNumber)
      body.append('b_email', beneficiary.emailAddress)
      body.append('b_address', beneficiary.address)
      body.append('s_fname', sender.firstName)
      body.append('s_mname', sender.middleName)
      body.append('s_lname', sender.lastName)
      body.append('s_bdate', sender.birthday)
      body.append('s_mobile', sender.mobileNumber)
      body.append('s_email', sender.emailAddress)
      body.append('s_address', sender.address)
      body.append('s_id', sender.idType)
      body.append('s_idno', sender.idNumber)
      body.append('amount', amount)
      body.append('purpose', sender.purposeofremittance)
      body.append('transpass', values.password)

      let res = await fetch('ecashcardlesspadala_confirm', {
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
          Modal.error({
            title: "Ecash Cardless Padala",
            content: (<>{result.M} <br /> The system will reload</>),
            onOk: () => { location.reload() }
          })
        })
        return;
      }

      if (result.S == 3) {
        this.setState({
          visible: false,
          otp: true,
          otpData: result,
          validateStatus: "", help: ""
        })
        return;
      }

      this.props.getsummaryDetails(result)
      this.props.stepProceed(4)

    } catch (error) {
      message.error("Please Try Again")
    }

  }


  handleCancel = () => {
    this.setState({ visible: false, otp: false })
  }

  rates = (amount) => {
    switch (true) {
      case (500 <= amount && 2000 >= amount):
        return 85.00;
      case (2001 <= amount && 4000 >= amount):
        return 145.00;
      case (4001 <= amount && 6000 >= amount):
        return 165.00;
      case (6001 <= amount && 8000 >= amount):
        return 185.00;
      case (8001 <= amount && 10000 >= amount):
        return 200.00;
      default:
        return 0;
    }
  }

  rateModal = () => {
    const data = {
      columns: [{
        title: "Amount Range",
        key: 'range',
        dataIndex: 'range'
      },
      {
        title: "Charge",
        key: 'rate',
        dataIndex: 'rate'
      },],
      dataSource: [{
        rate: "85.00",
        range: "500.00 - 2,000.00"
      },
      {
        rate: "145.00",
        range: "2,001.00 - 4,000.00"
      },
      {
        rate: "165.00",
        range: "4,001.00 - 6,000.00"
      },
      {
        rate: "185.00",
        range: "6,001.00 - 8,000.00"
      },
      {
        rate: "200.00",
        range: "8,001.00 - 10,000.00"
      }
      ],
      pagination: false
    }

    Modal.info({
      title: "Ecash Padala Rates",
      content: <Table {...data} />
    })
  }

  render() {

    const { sender, beneficiary, idType, amount, id } = this.props
    const { getFieldDecorator, getFieldValue } = this.props.form;
    const { visible, loading, validateStatus, help, otp, otpData } = this.state
    const rate = this.rates(amount)

    return (
      <Row style={{ marginTop: 20 }} type="flex" justify="space-around" gutter={24}>
        <Col align="center" span={18}>
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
                          message: "Password is required"
                        }],
                    })(
                      <Input.Password
                        style={{ width: "100%" }}
                        readOnly={(validateStatus === "validating")}
                        placeholder="Enter your Transaction Password" />
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
                      <Input.Password
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

              {sender.middleName ?
                <>
                  <Col align="left" span={12}>
                    Middle Name:
                        </Col>
                  <Col align="right" span={12}>
                    {sender.middleName}
                  </Col>
                </> : null}

              <Col align="left" span={12}>
                Last Name:
                      </Col>
              <Col align="right" span={12}>
                {sender.lastName}
              </Col>

              <Col align="left" span={12}>
                Birthday:
                      </Col>
              <Col align="right" span={12}>
                {sender.birthday}
              </Col>

              <Col align="left" span={12}>
                Address:
                      </Col>
              <Col align="right" span={12}>
                {sender.address}
              </Col>

              <Col align="left" span={12}>
                Mobile Number:
                      </Col>
              <Col align="right" span={12}>
                {sender.mobileNumber}
              </Col>

              <Col align="left" span={12}>
                Email Address:
                      </Col>
              <Col align="right" span={12}>
                {sender.emailAddress}
              </Col>

              <Col align="left" span={12}>
                Purpose of Remittance:
                </Col>
              <Col align="right" span={12}>
                {sender.purposeofremittance}
              </Col>

              <Col align="left" span={12}>
                {sender.idType}
              </Col>
              <Col align="right" span={12}>
                {sender.idNumber}
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


              {beneficiary.middleName ?
                <>
                  <Col align="left" span={12}>
                    Middle Name:
                        </Col>
                  <Col align="right" span={12}>
                    {beneficiary.middleName}
                  </Col>
                </> : null}

              <Col align="left" span={12}>
                Last Name:
                      </Col>
              <Col align="right" span={12}>
                {beneficiary.lastName}
              </Col>

              <Col align="left" span={12}>
                Birthday:
                      </Col>
              <Col align="right" span={12}>
                {beneficiary.birthday}
              </Col>

              <Col align="left" span={12}>
                Address:
                      </Col>
              <Col align="right" span={12}>
                {beneficiary.address}
              </Col>

              <Col align="left" span={12}>
                Mobile Number:
                      </Col>
              <Col align="right" span={12}>
                {beneficiary.mobileNumber}
              </Col>

              <Col align="left" span={12}>
                Email Address:
                      </Col>
              <Col align="right" span={12}>
                {beneficiary.emailAddress}
              </Col>

            </Row>
            <Divider>Transaction Details</Divider>
            <Row>
              <Col align="left" span={12}>
                Transaction Type:
                      </Col>
              <Col align="right" span={12}>
                Ecash Cardless Padala
                      </Col>

              <Col align="left" span={12}>
                Amount
                      </Col>
              <Col align="right" span={12}>
                {numeral(amount).format("0,00.00")}
              </Col>
              <Col align="left" span={12}>
                Charge
                      </Col>
              <Col align="right" span={12}>
                <Popover placement="left" content={"“Click here” for ecash cardless padala rates"} trigger="hover">
                  <Icon onClick={this.rateModal} type="question-circle" theme="twoTone" />
                </Popover> {numeral(rate).format("0,00.00")}
              </Col>
              <Col align="left" span={12}>
                Total Amount
                      </Col>
              <Col align="right" span={12}>
                {numeral(parseInt(amount) + rate).format("0,00.00")}
              </Col>
            </Row>
          </Card>
          <Card>
            <Col span={12}>
              <Button onClick={() => this.props.stepProceed(2)}>
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

                  .ant-modal-confirm-body > .anticon + .ant-modal-confirm-title + .ant-modal-confirm-content {
                    margin-left:0px;
                  }

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
                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzbSv_JlW0ZjoL8vtO63c2EJyrDh9Gl_9dCZobzhJHpKkSwaemKw" alt=""
                    style={{ width: "80px", height: "90px", paddingBottom: "10px" }} />
                </Col>

                <Col>
                  <span
                    style={{ fontWeight: 500, fontSize: 20 }}>
                    Transaction Successful</span>
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
                    <span ><span >Ecash Cardless Padala</span></span>
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
                  <span>PHP </span> {amount}
                </Col>
              </Row>
              <Row
                key="a"
                type="flex"
                justify="center"
                align="middle"
                style={{ marginTop: 30 }}>
                <Col style={{ marginBottom: 10 }} span={18} align="center">
                  <a href={summaryDetails.R} target="_blank" rel="noopener noreferrer">
                    <Icon style={{ fontSize: 20 }} type="file-pdf" /><br />
                    <span style={{ fontSize: 12 }}>Download a copy of your receipt</span>
                  </a>
                </Col>

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
