import { StyleSheet, Text, View , Image, Platform} from 'react-native'
import React, { useContext , useEffect, useState } from 'react'
import { SafeAreaView } from 'react-native-safe-area-context'
import { GlobalContext } from "../../context/GlobalProvider";
import { Link, Redirect, router } from 'expo-router';
import LoadingAnimation from '../../components/Loader';


const sharedCardStyles = {
  backgroundColor: '#fff',
  padding: 24,
  borderRadius: 16,
  shadowColor: '#000',
  shadowOffset: { width: 0, height: 2 },
  shadowOpacity: 0.25,
  shadowRadius: 3.84,
  elevation: 5,
  marginBottom: 16,

};
const ClientHome = () => {
  
  const { user, isLoading , refreshUser} = useContext(GlobalContext) // Access the context

  if (isLoading) {
    return <SafeAreaView style={styles.container}><Text>Loading...</Text></SafeAreaView>;
  }

  if (!user) {
    refreshUser(); // Call rehydrate to fetch user data again
    return null; 
  }

  return (
    

    <SafeAreaView style={styles.container}>
      <Text style={styles.title}>Welcome, {user.name}, to XYZ Dental Clinic</Text>
      <Text style={styles.subtitle}>Your smile is our priority!</Text>
      <Image
        source={require('@/assets/images/partial-react-logo.png')}
        style={styles.image}
      />
      <View style={styles.cardsContainer}>
        <ServiceCard />
        <View style={{width: 16}} />
        <ContactCard />
      </View>
    </SafeAreaView>

  );
};

const ServiceCard = () => {

  return (

    <View style={sharedCardStyles}>
      <Text style={styles.cardTitle}>Our Services</Text>
      <View>
        <Text style={styles.cardItem}>Dental Checkups</Text>
        <Text style={styles.cardItem}>Teeth Whitening</Text>
        <Text style={styles.cardItem}>Dental Implants</Text>
        <Text style={styles.cardItem}>Braces</Text>
      </View>
    </View>

  );

};


const ContactCard = () => {

  return (

    <View style={sharedCardStyles}>
      <Text style={styles.cardTitle}>Contact Us</Text>
      <View>
        <Text style={styles.cardItem}>123 Dental Street</Text>
        <Text style={styles.cardItem}>City, Country</Text>
        <Text style={styles.cardItem}>contact@xyzdentalclinic.com</Text>
        <Text style={styles.cardItem}>555-123-4567</Text>
      </View>
    </View>

  );

};


const styles = StyleSheet.create({

  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    padding: 24,
  },

  title: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 16,
  },

  subtitle: {
    fontSize: 18,
    marginBottom: 24,
  },

  image: {
    width: 300,
    height: 200,
    borderRadius: 16,
    marginBottom: 24,
  },

  cardsContainer: {
    flexDirection: 'row',
    justifyContent: 'space-between',
  },

  cardTitle: {
    fontSize: 18,
    fontWeight: 'bold',
    marginBottom: 16,
  },
  cardItem: {
    marginBottom: 8,
  },
});

export default ClientHome

