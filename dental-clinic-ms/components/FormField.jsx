import { StyleSheet, Text, View, TextInput, TouchableOpacity, } from 'react-native'
import React,  { useState } from 'react'
import { MaterialIcons } from '@expo/vector-icons';

const FormField = ({title, value, placeholder, handleChangeText, otherStyles, keyboardType, ...props}) => {
    const [secureTextEntry, setSecureTextEntry] = useState(true);
  return (
    <View style={styles.inputContainer}>
    <TextInput
      style={styles.input}
      placeholder={placeholder}
      value={value}
      onChangeText={handleChangeText}
      keyboardType={keyboardType}
      secureTextEntry = {title === 'Password' && secureTextEntry}
    />
    {title === 'Password' && (
    <TouchableOpacity onPress={() => setSecureTextEntry(!secureTextEntry)}>
      <MaterialIcons
        name={secureTextEntry ? 'visibility' : 'visibility-off'}
        size={24}
        color="#666"
      />
    </TouchableOpacity>
    )}
  </View>
  )
}


export default FormField


const styles = StyleSheet.create({
    inputContainer: {
        flexDirection: 'row',
        justifyContent: 'center',
        alignItems: 'center',
        borderColor: 'gray',
        borderWidth: 1,
        margin: 10,
        padding: 10,
        borderRadius: 20,
        width: 350,
      },
      input: {
        flex: 1,
        height: 40,
        padding: 10,
      },


})