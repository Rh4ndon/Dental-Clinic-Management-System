import React, { useState } from 'react';
import { View, Text, TextInput, TouchableOpacity, StyleSheet, Dimensions, Platform } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import CustomButton from '../../components/CustomButton';
import FormField from '../../components/FormField';
import { Link , router} from 'expo-router';
import { Alert } from 'react-native';
import * as Request from '../../lib/PhpRequest';

const SignUp = () => {


  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [address, setAddress] = useState('');

  const [isSubmitting, setIsSubmitting] = useState(false);



  const handleSignup = async () => {
      // Prevent multiple submissions
      if (isSubmitting) return;
      setIsSubmitting(true);

      // Check that the user has input all the required details
      if (!username || !password || !name || !email || !address) {
          
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
          username,
          password,
          name,
          email,
          address,
      };

      try{

        const result = await Request.signUp ({ userData });
        
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
      <Text style={styles.logo}>Logo</Text>

      <FormField 
        title="Name"
        placeholder="Full Name"
        value={name}
        handleChangeText={(text) => setName(text)}      
      />

      <FormField 
        title="Email"
        placeholder="Email"
        value={email}
        handleChangeText={(text) => setEmail(text)}   
        keyboardType="email-address"   
      />

      <FormField 
        title="Address"
        placeholder="Address"
        value={address}
        handleChangeText={(text) => setAddress(text)}      
      />
    
      <FormField 
        title="Username"
        placeholder="Username"
        value={username}
        handleChangeText={(text) => setUsername(text)}      
      />
      

      <FormField 
        title="Password"
        placeholder="Password"
        value={password}
        handleChangeText={(text) => setPassword(text)}      
      />

      
 
      <CustomButton 
        title={"Sign Up"}
        handlePress={handleSignup}
        isLoading={isSubmitting}
      />

      <View style={styles.dontHaveAccountContainer}>
        <Text style={styles.dontHaveAccountText}>Already have account?</Text>
        <Link style={styles.signUpLink} href="/sign-in">Sign In</Link>
      </View>
      {/*
      <Link style={styles.link} href="/sign-up">Forgot Password?</Link>
      */}
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

export default SignUp;