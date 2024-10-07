import { useContext } from 'react';
import { Link, router } from 'expo-router';
import { Platform, Alert } from 'react-native';
import { config } from './Config';
import AsyncStorage from '@react-native-async-storage/async-storage';



export const signUp = async ({ userData  }) => {
  const apiUrl = config.API_URL;

  // Make a POST request to your PHP API
  const response = await fetch(`${apiUrl}/signup.php`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(userData),
  });

  // Check if the response was successful
  if (response.ok) {
    console.log(`Sign-up successful!`);
    if (Platform.OS === 'web') {
      alert(`Sign-up Successful`);
    } else {
      Alert.alert(`Sign-up Successful`);
    }
    
      router.push(`(auth)/sign-in`); // Navigate to the login screen

  } else {
    console.error(`Sign-up failed:`, response.status);
    // Alerts
    if (Platform.OS === 'web') {
      alert(`Sign-up Failed Please try again later.`);
    } else {
      Alert.alert(`Sign-up Failed`, 'Please try again later.');
    }
  }
};

// Add your other functions here
export const signIn = async ({ userData }) => {
  const apiUrl = config.API_URL;
  const response = await fetch(`${apiUrl}/signin.php`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(userData),
  });



  if (response.ok) {
    const responseText = await response.text();
    const jsonData = responseText.replace(/<!--.*?-->/g, '');
    const responseData = JSON.parse(jsonData);

    if (responseData.success === false) {
      if (Platform.OS === 'web') {
        alert(responseData.error);
      } else {
        Alert.alert(responseData.error);
      }
      return;
    }
    
    if (Platform.OS === 'web') {
      // Use localStorage for web
      localStorage.setItem('user', JSON.stringify(responseData));
    } else {
      // Use AsyncStorage for mobile
      await AsyncStorage.setItem('user', JSON.stringify(responseData));
    }
  
    if (responseData.role === 'client') {
      router.push('../client/home');
    } else if (responseData.role === 'doctor') {
      router.push('../doctor/home');
    } else if (responseData.role === 'admin') {
      router.push('../admin/admin_dash');
    }

    if (Platform.OS === 'web') {
      alert('Sign-in Successful');
    } else {
      Alert.alert('Sign-in Successful');
    }
  } else {
    if (Platform.OS === 'web') {
      alert('Sign-in Failed. Please try again later.');
    } else {
      Alert.alert('Sign-in Failed', 'Please try again later.');
    }
  }
};

export const getDentists = async () => {
  try {
    const apiUrl = config.API_URL;
    const response = await fetch(`${apiUrl}/get-dentist.php`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    });
    const responseText = await response.text();
    const jsonData = responseText.replace(/<!--.*?-->/g, '');
    const responseData = JSON.parse(jsonData);
  
    if (responseData.success === false) {
      if (Platform.OS === 'web') {
        alert(responseData.error);
      } else {
        Alert.alert(responseData.error);
      }
      return;
    }
      
    if (Platform.OS === 'web') {
      // Use localStorage for web
      localStorage.setItem('dentist', JSON.stringify(responseData.data));
    } else {
      // Use AsyncStorage for mobile
      await AsyncStorage.setItem('dentist', JSON.stringify(responseData.data));
    }
  } catch (error) {
    console.log(error);
  }
};

export const getAppointments = async ({userID}) => {

  try {
    const apiUrl = config.API_URL;
    const response = await fetch(`${apiUrl}/get-appointment.php?user_id=${userID}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    });
    const responseText = await response.text();
    const jsonData = responseText.replace(/<!--.*?-->/g, '');
    const responseData = JSON.parse(jsonData);

    if (responseData.success !== false) {
      if (Platform.OS === 'web') {
        // Use localStorage for web
        localStorage.setItem('appointments', JSON.stringify(responseData.data));
      } else {
        // Use AsyncStorage for mobile
        await AsyncStorage.setItem('appointments', JSON.stringify(responseData.data));
      }
      

  
    }else{  
      console.log(responseData.error);
    }


  } catch (error) {
    console.log('getAppointments error:', error);
  }
};


export const createAppointment = async ({ appointmentData  }) => {
  const apiUrl = config.API_URL;

  // Make a POST request to your PHP API
  const response = await fetch(`${apiUrl}/create-appointment.php`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(appointmentData),
  });

  // Check if the response was successful
  if (response.ok) {
    console.log(`Appointment submitted successful!`);
    if (Platform.OS === 'web') {
      alert(`Appointment submitted Successful`);
    } else {
      Alert.alert(`Appointment submitted Successful`);
    }

  } else {
    console.error(`Appointment submission failed:`, response.status);
    // Alerts
    if (Platform.OS === 'web') {
      alert(`Appointment submission Failed Please try again later.`);
    } else {
      Alert.alert(`Appointment submission Failed`, 'Please try again later.');
    }
  }
};


