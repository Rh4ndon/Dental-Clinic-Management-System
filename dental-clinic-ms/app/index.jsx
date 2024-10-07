import React, { useContext } from 'react'
import { ScrollView, View, Image, Text, TouchableOpacity, StyleSheet, Platform } from 'react-native';
import { Link, Redirect, router } from 'expo-router';
import { SafeAreaView } from 'react-native-safe-area-context';
import { isLoading } from 'expo-font';
import { StatusBar } from 'expo-status-bar';
import CustomButton from '../components/CustomButton';
import { GlobalContext } from "../context/GlobalProvider";

const sharedStyles = {
  primaryButton: {
    backgroundColor: '#007bff', // adjust to your primary color
    color: '#ffffff',
    paddingHorizontal: 16,
    paddingVertical: 8,
    borderRadius: 8,
  },
  textCenter: {
    textAlign: 'center',
  },
  mb8: {
    marginBottom: 16,
  },
  mb4: {
    marginBottom: 8,
  },
  mb2: {
    marginBottom: 4,
  },
  
};

const Index = () => {
  const { user, isLoading, isLoggedIn } = useContext(GlobalContext)


  if (!isLoading && isLoggedIn) {
    if (user.role === 'admin') {
      return <Redirect href="/admin/admin_dash" />;
    } else if (user.role === 'client') {
      return <Redirect href="/client/home" />;
    } else if (user.role === 'doctor') {
      return <Redirect href="/doctor/dashboard" />;
    }
  }

  return (
    <SafeAreaView style={styles.container}>
      <ScrollView contentContainerStyle={styles.scrollView}>
        <Image
          source={require('@/assets/images/logo.png')}
          style={[styles.mb8, { width: '100%', height: 200, resizeMode: 'contain' }]}
        />
        <Text className="font-pblack" style={[styles.h1, styles.mb4]}>
          {"\n"}
          Welcome to BrightBite Dental Clinic 👋
        </Text>
        <Text style={[styles.p, styles.textCenter, styles.mb2, { paddingHorizontal: 16 }]}>
          {"\n"}
          Providing top-notch dental care for you and your family. Schedule an appointment today! 
          {"\n"}
        </Text>
   
        <CustomButton 
        title="Book an Appointment"
        handlePress={() => router.push('/sign-in')}
        />
    
      </ScrollView>
      <StatusBar
      backgroundColor="black"
      style="light"/>

    </SafeAreaView>
  );
};



const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#f0f0f0', // adjust to your background color
    justifyContent: 'center',
    alignItems: 'center',
  },
  scrollView: {
    flexGrow: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  h1: {
    fontSize: 24,
    fontWeight: 'bold',
  },
  p: {
    fontSize: 18,
  },
});

export default Index;
