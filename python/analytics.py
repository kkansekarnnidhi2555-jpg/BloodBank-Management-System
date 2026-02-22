import mysql.connector
import pandas as pd
import matplotlib.pyplot as plt

conn = mysql.connector.connect(host='127.0.0.1', user='root', password='', database='bloodbank_db')
df = pd.read_sql('SELECT blood_group, quantity_ml FROM blood_inventory', conn)
print(df)
df.plot(kind='bar', x='blood_group', y='quantity_ml', legend=False)
plt.title('Blood Inventory Levels')
plt.xlabel('Blood Group')
plt.ylabel('Quantity (ml)')
plt.tight_layout()
plt.show()
df.to_csv('inventory_report.csv', index=False)
print('Saved inventory_report.csv')
