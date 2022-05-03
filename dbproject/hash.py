import hashlib
import sys

def generate_hash(pswd):
    pswd = str(pswd)
    pswd = pswd.encode('utf-8')
    return hashlib.sha224(pswd).hexdigest()

if __name__ == "__main__":
    assert len(sys.argv) == 2
    print(generate_hash(sys.argv[1]))
# p = []
# for password in ['mint','kevin','david','gusi','user','uva']:
#     p.append(generate_hash(password))

# print(generate_hash('mint'))
