#!/bin/env python
import pandas as pd
from sklearn.linear_model import LogisticRegression
from sklearn import preprocessing
import numpy as np

df = pd.read_csv("trainSet.csv", encoding='CP1255')
le_result = preprocessing.LabelEncoder()
le_result.fit(df['Result'])
df['target'] = le_result.transform(df['Result'])
    
le_gender = preprocessing.LabelEncoder()
le_gender.fit(df['Gender'])
df['Gender_numeric'] = le_gender.transform(df['Gender'])
    
le_license = preprocessing.LabelEncoder()
le_license.fit(df['Type of License'])
df['License_numeric'] = le_license.transform(df['Type of License'])
    
le_education = preprocessing.LabelEncoder()
le_education.fit(df['Education'])
df['Education_numeric'] = le_education.transform(df['Education'])
    
df_new = df.drop(columns=['Education', 'Type of License', 'Gender', 'Result'])
features = df_new.drop(columns=['target'])
labels = df_new['target']
    
clf = LogisticRegression(random_state=1234, max_iter=1000, C=10, penalty='l1', solver='liblinear')
clf.fit(features, labels)
    
test_set = pd.read_csv('/home/isnivyn/public_html/testSet.csv')
new_record1 = test_set.tail(1).copy()
new_record = test_set.tail(1).copy()
new_record.loc[:, 'Gender_numeric'] = le_gender.transform(new_record['Gender'])
new_record.loc[:, 'License_numeric'] = le_license.transform(new_record['Type of License'])
new_record.loc[:, 'Education_numeric'] = le_education.transform(new_record['Education'])
new_record = new_record.drop(columns=['Gender', 'Type of License', 'Education'])
    
feature_order = ['Number of Driving Lessons', 'Number of Lessons to Reach 100% Personal Goals', 'Age', 'Teacher Rating', 'Gender_numeric', 'License_numeric', 'Education_numeric']
X = pd.DataFrame(data=new_record, columns=feature_order)

predict = clf.predict(X)
result_df = pd.DataFrame({'Result': predict})
# Write the DataFrame to a CSV file
result_df.to_csv('results.csv', mode='a', header=False, index=False)

prob = np.amax(clf.predict_proba(X))
prob_percentage = f"{prob*100:.2f}%"
if predict == 0:
    print(f"<div style='text-align: center;'><span style='font-size: 30px; font-weight: bold;'>{prob_percentage}  שהתלמיד לא יעבור את הבחינה המעשית</span></div>")
else:
    print(f"<div style='text-align: center;'><span style='font-size: 30px; font-weight: bold;'>{prob_percentage}  שהתלמיד יעבור את הבחינה המעשית</span></div>")
    
if predict == 0:
    new_record1['Result'] = 'Fail'
else:
    new_record1['Result'] = 'Pass'
new_record1.to_csv('trainSet.csv', mode='a', encoding='CP1255', header=False, index=False)
