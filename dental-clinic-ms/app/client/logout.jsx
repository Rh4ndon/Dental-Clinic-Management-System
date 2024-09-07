import { StyleSheet, View, Text } from 'react-native'
import { Link, router } from 'expo-router';
import React ,{useContext} from 'react'
import { GlobalContext } from "../../context/GlobalProvider";
import CustomButton from '../../components/CustomButton'
import { SafeAreaView } from 'react-native-safe-area-context';

const Logout = () => {
    
  const { logout } = useContext(GlobalContext) // Access the context

  const handleLogout = () => {
    logout()
    router.replace('../(auth)/sign-in');
  }


  return (
    <SafeAreaView style={styles.container}>
      <Text style={styles.text}>Are you sure want to logout?</Text>
      <CustomButton 
        title="Logout"
        handlePress={handleLogout}
        containerStyle={styles.buttonContainer}
      />
    </SafeAreaView>
  )
}

export default Logout

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  text: {
    textAlign: 'center',
    fontSize: 24,
    marginBottom: 16,
  },
  buttonContainer: {
    marginTop: 16,
  }
})

