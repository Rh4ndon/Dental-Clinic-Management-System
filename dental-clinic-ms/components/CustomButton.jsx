
import { TouchableOpacity, Text, View, StyleSheet } from 'react-native'
import React from 'react'

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

const CustomButton = ({ title, handlePress, containerStyle, textStyles, isLoading }) => {
  return (
    <TouchableOpacity
    activeOpacity={0.8}
    onPress={handlePress}
    className={`items-center justify-center ${containerStyle} ${isLoading ? 'opacity-50' : ''}`}
    disabled={isLoading}
    style={[sharedStyles.primaryButton,{ backgroundColor: 'black' }]}>
      <Text 
      style={{
        color: 'white',
        fontFamily: 'Poppins-SemiBold',
        fontSize: 18,
      }}
      className={ `${textStyles}`}
      >
        {title}
      </Text>
    </TouchableOpacity>
  )
}

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


export default CustomButton

