const rootElement = document.getElementById('root')
const { Col , List , Row, Tabs , Spin} = window.antd;
const {Snackbar, AppBar , Container , Icon, Typography, Toolbar, Breadcrumbs, Link , Card, CardMedia, CardContent, CardActions, Button, Dialog, DialogActions, DialogContent, DialogContentText, DialogTitle, Slide, Modal, Backdrop, Box, TextField, IconButton, OutlinedInput, InputLabel, InputAdornment, FormControl } = window.MaterialUI;
const { TabPane } = Tabs;

const Transition = React.forwardRef(function Transition(props, ref) {
  return <Slide direction="up" ref={ref} {...props} />;
});

function SlideTransition(props) {
  return <Slide {...props} direction="up" />;
}

const ModalStyle = {
  position: 'absolute',
  top: '50%',
  left: '50%',
  transform: 'translate(-50%, -50%)',
  width: '50%',
  bgcolor: 'background.paper',
  border: '0.5px solid #000',
  boxShadow: 24,
  p: 4,
};

class Display extends React.Component {
  constructor() {
    super();
    this.state = {  
      panelList: ''
    }
  }

  componentDidMount ()
  {
    this.SmartProductListandImages();
  }

  SmartProductListandImages = async () => {
    try {
        let res = await fetch('smartListandImages', {
            method: "POST"
        })
        let result = await res.json()
        this.setState({ panelList: result });
    } catch (error) {
    }
  }

  render() {
    const { panelList } = this.state;
    return (
      <Row className='displaycontainer'>
        <AppBar position="static" className='Appbar'>
          <Container maxWidth="xl">
            <Toolbar disableGutters>
              <Icon className="phoneicon">phone_android</Icon>
              <Breadcrumbs aria-label="breadcrumb" className="breadcrumbs">
                <Typography
                  sx={{ display: 'flex', alignItems: 'center' }}
                  color="text.primary"
                >
                  <span className="breadcrumbText">HOME</span>
                </Typography>
                <Typography
                  sx={{ display: 'flex', alignItems: 'center' }}
                  color="text.primary"
                >
                  <span className="breadcrumbText">E_LOADING</span>
                </Typography>
                <Typography
                  sx={{ display: 'flex', alignItems: 'center' }}
                  color="text.primary"
                >
                  <span className="breadcrumbText">SMART LOADING</span>
                </Typography>
              </Breadcrumbs>
            </Toolbar>
          </Container>
        </AppBar>
        {panelList.length > 0 && (
          <Tabs defaultActiveKey="0" className="tabs">
            {
              panelList.map((item , key)=> {
                return (
                <TabPane tab={item.category} key={key}>
                  <Smartload loads={item.category} images={item.imagelink} />
                </TabPane>
                )
              })
            }
          </Tabs>
        )}
      </Row>
    )
  }
}

class Smartload extends React.Component{
  constructor() {
    super();
    this.state = {  
      loadingTable: '',
      modalLoadingTable: '',
      allList: [],
      learnmoreDialog: '',
      dialogList: [],
      modalView: '',
      modalList: [],
      mobilenumber: '',
      fullname: '',
      emailAddress: '',
      password: '',
      showPassword: false,
      categoryList: '',
      imageList: '',
      helperText: {
        mobile: '',
        full: '',
        email: '',
        tpass: ''
      },
      errorHelper: {
        errorMobile: '',
        errorFull: '',
        errorEmail: '',
        errorTPass: ''
      },
      responseView: '',
      responseList: '',
      Transition: 'Fade'
    }
  }

  componentDidMount(){
    this.SmartProductList();
    this.setState({ categoryList: this.props.loads , imageList: this.props.images })
  }

  SmartProductList = async () => {
    await this.setState({ loadingTable: true })
    try {
        let res = await fetch('smartList', {
            method: "POST"
        })
        let result = await res.json()
        this.setState({ allList: result , loadingTable: false });
    } catch (error) {
      await this.setState({ loadingTable: false })
    }
  }

  openDialog = (item) => {
    this.setState({ learnmoreDialog: true , dialogList: item });
  }
  
  closeDialog = () => {
    this.setState({ learnmoreDialog: false });
  }

  openModal = (item) => {
    this.setState({ modalView: true , modalList: item });
  }

  closeModal = () => {
    this.setState({ modalView: false , modalList: [] });
  }

  clickedShowPassword = () => {
    this.setState({ showPassword: !this.state.showPassword })
  };

  MouseDownPassword = (event) => {
    event.preventDefault();
  };

  onPaste = (event) => {
    event.preventDefault();
  }

  onDrop = (event) => {
    event.preventDefault();
  }

  onLyNumber = (event) => {
    const regexp = /[0-9]+/g;
    if(!regexp.test(event.key)){
      event.preventDefault();
    }
  }

  onLyLetterDotSpace = (event) => {
    const regexp = /^[a-zA-Z\s\.]+$/;
    if(!regexp.test(event.key)){
      event.preventDefault();
    }
  }

  changeValue = (e,type) => {
    if(type === 'mnumber'){
      this.setState({ mobilenumber: e.target.value });
      if(e.target.value.length > 0){
        this.setState(prevState => ({
          helperText:{
            ...prevState.helperText,
            ['mobile']: ''
          },
          errorHelper:{
            ...prevState.errorHelper,
            ['errorMobile']: false 
          }
        }));
      }else {
        this.setState(prevState => ({
          helperText:{
            ...prevState.helperText,
            ['mobile']: 'Please Fill out Recipient Mobile Number'
          },
          errorHelper:{
            ...prevState.errorHelper,
            ['errorMobile']: true 
          }
        }));
      }
    }
    if(type === 'fullname'){
      this.setState({ fullname: e.target.value });
      if(e.target.value.length > 0){
        this.setState(prevState => ({
          helperText:{
            ...prevState.helperText,
            ['full']: ''
          },
          errorHelper:{
            ...prevState.errorHelper,
            ['errorFull']: false 
          }
        }));
      }else {
        this.setState(prevState => ({
          helperText:{
            ...prevState.helperText,
            ['full']: 'Please Fill out Recipient Name'
          },
          errorHelper:{
            ...prevState.errorHelper,
            ['errorFull']: true 
          }
        }));
      }
    }
    if(type === 'email'){
      this.setState({ emailAddress: e.target.value });
      if(e.target.value.length > 0){
        this.setState(prevState => ({
          helperText:{
            ...prevState.helperText,
            ['email']: ''
          },
          errorHelper:{
            ...prevState.errorHelper,
            ['errorEmail']: false 
          }
        }));
      }else {
        this.setState(prevState => ({
          helperText:{
            ...prevState.helperText,
            ['email']: 'Please Fill out Recipient Email'
          },
          errorHelper:{
            ...prevState.errorHelper,
            ['errorEmail']: true 
          }
        }));
      }
    }
    if(type === 'tpass'){
      this.setState({ password: e.target.value });
      if(e.target.value.length > 0){
        this.setState(prevState => ({
          helperText:{
            ...prevState.helperText,
            ['tpass']: ''
          },
          errorHelper:{
            ...prevState.errorHelper,
            ['errorTPass']: false 
          }
        }));
      }else {
        this.setState(prevState => ({
          helperText:{
            ...prevState.helperText,
            ['tpass']: 'Please Fill out Transaction Password'
          },
          errorHelper:{
            ...prevState.errorHelper,
            ['errorTPass']: true 
          }
        }));
      }
    } 
  }
  
  handleSubmit = async (event) => {
    event.preventDefault();

    const { mobile, fullname, email, tpass } = event.target.elements
    const { sku , denom_type } = this.state.modalList;

    await this.setState({ modalLoadingTable: true })
    try {

        const dataforms = new FormData();
        dataforms.append('sku',sku);
        dataforms.append('denom',denom_type);
        dataforms.append('recipientName',fullname.value);
        dataforms.append('recipientEmail',email.value);
        dataforms.append('recipientMobile',mobile.value);
        dataforms.append('tpass',tpass.value);
        
        let res = await fetch('smartInsert', {
            method: "POST",
            body: dataforms
        })
        let result = await res.json();
        if(result.S === 1){
          await setTimeout(
            () => this.setState({ modalLoadingTable: false , modalView: false }), 
            1000
          );
          this.setState({ responseView: true , responseList: 'SUCCESSFULLY ADDED'});
        }else{
          setTimeout(
            () => this.setState({ modalLoadingTable: false }), 
            500
          );
          this.setState({ responseView: true , responseList: result.M });
        }
    } catch (error) {
      await this.setState({ modalLoadingTable: false })
    }
  }

  render(){

    const { responseView, Transition, responseList, loadingTable, modalLoadingTable, learnmoreDialog, dialogList, modalView, modalList, mobilenumber, fullname, emailAddress, password, showPassword, categoryList, imageList, helperText, errorHelper } = this.state;
    const ListSmart = this.state.allList.filter(list => {
      if(list.category === categoryList ){
        return list;
      }
    });

    const list = (
      <List
        grid={{ gutter: 16, xs: 1, sm: 2, md: 1, lg: 2, xl: 3, xxl: 3, }}
        dataSource={ListSmart}
        itemLayout="horizontal"
        size="large"
        renderItem={(item) => (
          <List.Item>
            <Card sx={{ maxWidth: 500 }} className="smartcard">
              <div className="smartcard2" onClick={()=> this.openModal(item)}>
                <CardMedia
                  component="img"
                  className="cardmediaimage"
                  image= {imageList}
                />
                <CardContent>
                  <Typography gutterBottom variant="h5" component="div" className="primary">
                    {item.sku}
                  </Typography>
                  <Typography variant="body2" color="text.secondary" className="secondary">
                    {item.product_name}
                  </Typography>
                </CardContent>
              </div>
              <CardActions>
                <Card className="learnbutton">
                  <Button size="small" onClick={()=> this.openDialog(item)}>Learn More</Button>
                </Card>
              </CardActions>
            </Card>
          </List.Item>
        )}
      >
      </List>
    );

    return (
      <Row>
        <Card>
          <div className="demo-infinite-container">
            { loadingTable ? 
              <div>
                <div className="ring">Loading
                  <div className="spans"></div>
                </div>
                {list}
              </div> : 
              <div>
                {list}
              </div>
            }
          </div>
        </Card>
        <Snackbar
          anchorOrigin={{
            vertical: "top",
            horizontal: "center"
          }}
          autoHideDuration={2000}
          open={responseView}
          onClose={() => this.setState({responseView: false})}
          TransitionComponent={Transition}
          message={<span className="responseMessage">{responseList}</span>}
          key={'top'+'center'}
        />
        <Modal
          aria-labelledby="spring-modal-title"
          aria-describedby="spring-modal-description"
          open={modalView}
          onClose={this.closeModal}
          keepMounted
          BackdropComponent={Backdrop}
          BackdropProps={{
            timeout: 500,
          }}
        >
          <Box sx={ModalStyle}>
            <form onSubmit={(e)=>this.handleSubmit(e)}>
              <Typography gutterBottom variant="h5" component="div" className="modalTitle">
                {modalList.product_name}
              </Typography>
              <div className="TextFieldModal">
                <TextField
                  id="mobile"
                  label="Recipient Mobile Number"
                  placeholder="Recipient Mobile Number"
                  value={mobilenumber ? mobilenumber: ''}
                  variant="outlined"
                  required
                  onPaste={this.onPaste}
                  onDrop={this.onDrop}
                  onKeyPress={this.onLyNumber}
                  style={{ width: '100%' }}
                  onChange={(e)=>this.changeValue(e,'mnumber')}
                  helperText={helperText.mobile}
                  error={errorHelper.errorMobile}
                  InputProps={{ style: { fontSize: 16, fontFamily: 'Open Sans', fontWeight: 'bold' } }}
                  InputLabelProps={{ style: { fontSize: 16, fontFamily: 'Open Sans', fontWeight: 'bold' } , required: false }}
                />
              </div>
              <div className="TextFieldModal">
                <TextField
                  id="fullname"
                  label="Recipient Name"
                  placeholder="Recipient Name"
                  value={fullname ? fullname: ''}
                  variant="outlined"
                  onPaste={this.onPaste}
                  onDrop={this.onDrop}
                  required
                  onKeyPress={this.onLyLetterDotSpace}
                  style={{ width: '100%' }}
                  onChange={(e) => this.changeValue(e,'fullname')}
                  helperText={helperText.full}
                  error={errorHelper.errorFull}
                  InputProps={{ style: { fontSize: 16, fontFamily: 'Open Sans', fontWeight: 'bold' } }}
                  InputLabelProps={{ style: { fontSize: 16, fontFamily: 'Open Sans', fontWeight: 'bold' } , required: false }}
                />
              </div>
              <div className="TextFieldModal">
                <TextField
                  id="email"
                  label="Recipient Email"
                  placeholder="Recipient Email"
                  type="email"
                  value={emailAddress ? emailAddress: ''}
                  variant="outlined"
                  onPaste={this.onPaste}
                  onDrop={this.onDrop}
                  style={{ width: '100%' }}
                  required
                  onChange={(e) => this.changeValue(e,'email')}
                  helperText={helperText.email}
                  error={errorHelper.errorEmail}
                  InputProps={{ style: { fontSize: 16, fontFamily: 'Open Sans', fontWeight: 'bold' } }}
                  InputLabelProps={{ style: { fontSize: 16, fontFamily: 'Open Sans', fontWeight: 'bold' }, required: false }}
                />
              </div>
              <div className="TextFieldModal">
                <TextField
                  id="tpass"
                  label="Transaction Password"
                  placeholder="Transaction Password"
                  type={showPassword ? 'text' : 'password'}
                  value={password ? password: ''}
                  variant="outlined"
                  style={{ width: '100%' }}
                  required
                  onChange={(e)=>this.changeValue(e,'tpass')}
                  helperText={helperText.tpass}
                  error={errorHelper.errorTPass}
                  InputProps={{ style: { fontSize: 16, fontFamily: 'Open Sans', fontWeight: 'bold' },
                    endAdornment:
                    <InputAdornment position="end">
                      <IconButton
                        aria-label="toggle password visibility"
                        onClick={this.clickedShowPassword}
                        onMouseDown={this.MouseDownPassword}
                        edge="end"
                      >
                        {showPassword ? <Icon>visibility_off</Icon> : <Icon>visibility</Icon>}
                      </IconButton>
                    </InputAdornment>
                  }}
                  InputLabelProps={{ style: { fontSize: 16, fontFamily: 'Open Sans', fontWeight: 'bold' } , required: false }}
                />
              </div>
              <div className="TextFieldModal">
                <Button className="submitButton" type="submit">
                    <span className="submitDesign">SUBMIT</span>
                </Button>
              </div>
            </form>
            { modalLoadingTable ? 
                <div className="ring">Loading
                  <div className="spans"></div>
                </div> : '' }
          </Box>
        </Modal>
        <Dialog
          open={learnmoreDialog}
          TransitionComponent={Transition}
          keepMounted
          maxWidth="md"
          onClose={this.closeDialog}
          aria-describedby="alert-dialog-slide-description"
        >
          <DialogTitle>{<span className="dialogTitle">{dialogList.product_name+" (₱"+dialogList.amount+")"}</span>}</DialogTitle>
          <DialogContent>
            <DialogContentText id="alert-dialog-slide-description">
            {<span className="dialogDesc">{dialogList.desc}</span>}
            </DialogContentText>
          </DialogContent>
        </Dialog>
        
      </Row>
    )
  }
}


function App() {
    return (
      <div>
        <Display />
      </div>
    )
}
  
ReactDOM.render(
    <App />,
    rootElement
)