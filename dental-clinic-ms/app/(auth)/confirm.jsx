import React, { useState, useContext } from 'react';
import { View, Text, Image, TextInput, TouchableOpacity, StyleSheet, Dimensions, Platform, Alert } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import CustomButton from '../../components/CustomButton';
import FormField from '../../components/FormField';
import { Link, router, Redirect } from 'expo-router';
import * as Request from '../../lib/PhpRequest';
import { GlobalContext } from '../../context/GlobalProvider';
import AsyncStorage from '@react-native-async-storage/async-storage';


const Confirm = () => {

  const {code, refreshCode} = useContext(GlobalContext) // Access the context

  if(!code){
    refreshCode();
  }


  const [pin, setPin] = useState('');

  
  const [isSubmitting, setIsSubmitting] = useState(false);




  const handleLogin = async() => {
     // Prevent multiple submissions
      if (isSubmitting) return;
      setIsSubmitting(true);
      // Check that the user has input all the required details
      if (!pin ) {
          
        if (Platform.OS === 'web') {
          alert('Please fill in all the details');
        } else {
          Alert.alert('Please fill in all the details');
        }
        setIsSubmitting(false);
        return;
      }

      // Create a JSON payload for the PHP API
      const userData = {
          pin
      };

      // Make a POST request to your PHP API
      try {
        if(pin === code.pin){
          router.push(`client/home`);
          if (Platform.OS === 'web') {
            // Use localStorage for web
            localStorage.setItem('user', JSON.stringify(code));
            
       
          } else {
            // Use AsyncStorage for mobile
            await AsyncStorage.setItem('user', JSON.stringify(code));
 
          }
        }else{
          
          if (Platform.OS === 'web') {
              alert('Invalid Pin Code');
          } else {
              Alert.alert('Error', 'Invalid Pin Code');
          }
        }      
        
        setIsSubmitting(false);
      } catch (error) {

          console.error('Error making request:', error);
          // Alerts
          if (Platform.OS === 'web') {
              alert('Error Something went wrong. Please try again later.', error)
          } else {
              Alert.alert('Error', 'Something went wrong. Please try again later.');
          }
          setIsSubmitting(false);
      } 
   
  };

  return (
    <SafeAreaView style={styles.container}>
      <Image
        source={require('../../assets/images/logo.png')}
        style={{width: 150, height: 150, resizeMode: 'contain'}}
      />

    
      <FormField 
        title="PinCode"
        placeholder="Pin Code"
        value={pin}
        handleChangeText={(text) => setPin(text)}
        keyboardType="numeric"      
      />

      
 
      <CustomButton 
        title={"Submit"}
        handlePress={handleLogin}
        isLoading={isSubmitting}
      />

    </SafeAreaView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#f0f0f0',
    padding: 20,
  },
  logo: {
    fontSize: 24,
    textAlign: 'center',
    margin: 10,
  },
  inputContainer: {
    flexDirection: 'row',
    justifyContent: 'center',
    alignItems: 'center',
    borderColor: 'gray',
    borderWidth: 1,
    margin: 10,
    padding: 10,
    borderRadius: 20,
  },
  input: {
    flex: 1,
    height: 40,
    padding: 10,
  },


  link: {
    color: 'blue',
    marginTop: 10,
  },
  dontHaveAccountContainer: {
    flexDirection: 'row',
    justifyContent: 'center',
    alignItems: 'center',
    marginTop: 10,
  },
  dontHaveAccountText: {
    color: 'gray',
    fontSize: 16,
    fontWeight: 'bold',
  },
  signUpLink: {
    color: 'blue',
    fontSize: 16,
    fontWeight: 'bold',
    marginLeft: 5,
  },
});

export default Confirm;
