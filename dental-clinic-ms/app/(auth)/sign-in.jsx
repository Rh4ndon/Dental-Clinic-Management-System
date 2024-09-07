import React, { useState, useContext } from 'react';
import { View, Text, TextInput, TouchableOpacity, StyleSheet, Dimensions, Platform } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import CustomButton from '../../components/CustomButton';
import FormField from '../../components/FormField';
import { Link, router, Redirect } from 'expo-router';
import * as Request from '../../lib/PhpRequest';
import { GlobalContext } from '../../context/GlobalProvider';

import { Alert } from 'react-native';

const SignIn = () => {

  const { user, isLoggedIn, isLoading } = useContext(GlobalContext) // Access the context

  if (!isLoading && isLoggedIn) {
    if (user.role === 'admin') {
      return <Redirect href="/admin/admin_dash" />;
    } else if (user.role === 'client') {
      return <Redirect href="/client/home" />;
    } else if (user.role === 'doctor') {
      return <Redirect href="/doctor/dashboard" />;
    }
  }
 

  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  
  const [isSubmitting, setIsSubmitting] = useState(false);




  const handleLogin = async() => {
     // Prevent multiple submissions
      if (isSubmitting) return;
      setIsSubmitting(true);
      // Check that the user has input all the required details
      if (!username || !password ) {
          
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
      };

      // Make a POST request to your PHP API
      try {

        await Request.signIn ({ userData });
        
        
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
        title={"Login"}
        handlePress={handleLogin}
        isLoading={isSubmitting}
      />

      <View style={styles.dontHaveAccountContainer}>
        <Text style={styles.dontHaveAccountText}>Don't have an account?</Text>
        <Link style={styles.signUpLink} href="/sign-up">Sign Up</Link>
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

export default SignIn;