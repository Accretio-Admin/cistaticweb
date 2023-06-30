<?php if(! defined('BASEPATH')) exit('No direct script access allow');
   
    class Encryption_model extends CI_Model{

      function encrypt_value($value, $key = 'jOr3lp()g!sob@nG4wap0h!!'){
            return rtrim(
                base64_encode(
                    mcrypt_encrypt(
                        MCRYPT_RIJNDAEL_256,
                        $key, $value, 
                        MCRYPT_MODE_ECB, 
                        mcrypt_create_iv(
                            mcrypt_get_iv_size(
                                MCRYPT_RIJNDAEL_256, 
                                MCRYPT_MODE_ECB
                            ), 
                            MCRYPT_RAND)
                        )
                    ), "\0"
                );
        }

        function decrypt_value($value, $key = 'jOr3lp()g!sob@nG4wap0h!!'){
            return rtrim(
                mcrypt_decrypt(
                    MCRYPT_RIJNDAEL_256, 
                    $key, 
                    base64_decode($value), 
                    MCRYPT_MODE_ECB,
                    mcrypt_create_iv(
                        mcrypt_get_iv_size(
                            MCRYPT_RIJNDAEL_256,
                            MCRYPT_MODE_ECB
                        ), 
                        MCRYPT_RAND
                    )
                ), "\0"
            );
        }
  }

  

                        


    
                